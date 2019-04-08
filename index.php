<?php

require_once __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
include 'controllers/AuthController.php';
include 'models/User.php';
include 'models/Post.php';
include 'controllers/PostController.php';



$klein = new \Klein\Klein();

$klein->respond('POST', '/auth/login', function ($request, $response) {

    $response->header('Content-Type','application/json');      
    $username=$request->username;
    $password=$request->password;

   
      if(empty($username) || empty($password))
        {
    	   $response->code(400);
           $data = array(
            'data'=>'',
            'message' => 'fields not valid');

            return json_encode($data);
        }

      try{

         $authController=new AuthController();
         $user=new User($username,$password);
         $result=$authController->login($user);

         if (!$result) 
         {
            $response->code(401);
             $data = array(
            'data'=>'',
            'message' => 'unauthorized user');

             return json_encode($data);
             
         }
        else
         {

            // create token
            $time = time();
            $key = 'my_secret_key';
            $token = array(
            'iat' => $time, // Time the token started
            'exp' => $time + (60*60), // Time the token will expire (15 minutes)
            'data' => [ // user information
            'username' => $result->getUsername()
            ]
        );

            $jwt = JWT::encode($token, $key);
            $data = array(
            'data'=>$jwt,
            'message' => 'logged in user');

             return json_encode($data);
           }
        }catch(Exception $e)
        {
            $response->code(500);
            $data = array(
            'data'=>'',
            'message' => 'error on the server');

             return json_encode($data);
        }   
});

$klein->respond('POST','/auth/logout',function ($request,$response){




});

$klein->respond('POST','/post',function ($request,$response){

    $response->header('Content-Type','application/json');      
    $title=$request->title;
    $author=$request->author;
    $content=$request->content;
    $token=$request->token;
   
      if(empty($title) || empty($author) || empty($content)||empty($token))
        {
         $response->code(400);
         $data = array(
            'data'=>'',
            'message' => 'fields not valid');

             return json_encode($data);
        }


        $key = 'my_secret_key';
        try
        {
            $data = JWT::decode($token, $key, array('HS256'));
        }catch(Exception $e)
        {

            $response->code(401);
             $data = array(
            'data'=>'',
            'message' => 'unauthorized user');
             return json_encode($data);
        }
       
       try
       {

           $postController=new PostController();
           $post=new Post(-1,$title,$author,$content,null,null);
           $result=$postController->createPost($post);

            if($result)
            {
                $response->code(201);
                 $data = array(
                'data'=>array('id' =>$result->getId(),
                           'title'=>$result->getTitle(),
                           'author'=>$result->getAuthor(),
                           'content'=>$result->getContent(),
                           'dateCreated'=>$result->getDateCreated(),
                           'dateUpdated'=>$result->getDateUpdated() 
                            ),
                'message' => 'create post');
                return json_encode($data);
            }    
       } catch(Exception $e)
       {
            $response->code(500);
            $data = array(
            'data'=>'',
            'message' => 'error on the server');
             return json_encode($data);
       }
     
            
});

$klein->respond('POST','/auth/register',function ($request,$response){
    $username=$request->username;
    $password=$request->password;


    $authController=new AuthController();
    $user=new User($username,$password);

    $authController->register($user);

     return "exitoso registro";
});

$klein->dispatch();