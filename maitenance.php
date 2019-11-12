<?php

use \Click\PageMaitenance;
use \Click\Model\UserMaitenance;

$app->get('/maitenance', function() {
    

  UserMaitenance:: verifyLogin();

  $page = new PageMaitenance();
  $page->setTpl("index");

});


$app->get('/maitenance/login', function() {

  $page = new PageMaitenance([
    "header"=>false,
    "footer"=>false
  ]);

  $page->setTpl("login",[

    'error'=>UserMaitenance::getError(),
    'errorRegister'=>UserMaitenance::getErrorRegister(),
    'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues']: ['name'=>'', 'email'=>'','phone'=>'']

  ]);

});

$app->post('/maitenance/login', function() {

try{
  UserMaitenance::login($_POST["login"], $_POST["password"]);
}catch(Exception $e){

    UserMaitenance::setError($e->getMessage());
  }
  header("Location: /maitenance");
  exit;

});

$app->get('/maitenance/logout', function() {
    
   UserMaitenance::logout();

   header("Location: /maitenance/login");
   exit;

});

$app->get('/maitenance/forgot', function() {
    
    $page = new PageMaitenance([

      "header" => false,
      "footer" =>false

    ]);
     $page->setTpl("forgot");

});

$app->post('/maitenance/forgot', function() {
    
  $user = UserMaitenance::getForgot($_POST["email"]);  
  header("Location: /maitenance/forgot/sent");
  exit;

});

$app->get('/maitenance/forgot/sent', function() {
    
   $page = new PageMaitenance([

      "header" => false,
      "footer" =>false

    ]);
     $page->setTpl("forgot-sent");

});

$app->get('/maitenance/forgot/reset', function() {

  $user = UserMaitenance::validForgotDecrypt($_GET["code"]);
    
   $page = new PageMaitenance([

      "header" => false,
      "footer" =>false
    ]);

     $page->setTpl("forgot-reset", array(

      "name"=>$user["desperson"],
      "code"=>$_GET["code"]
  
     ));

});

$app->post("/maitenance/forgot/reset", function(){

  $forgot = UserMaitenance::validForgotDecrypt($_POST["code"]);

  UserMaitenance::setFogotUsed($forgot["idrecovery"]);

  $user = new UserMaitenance();

  $user->get((int) $forgot["iduser"]);

  $options = [
    'cost' => 12,
  ];

  $password = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);

  $user->setPassword($password);

  $page = new PageMaitenance([

      "header" => false,
      "footer" =>false
    ]);

     $page->setTpl("forgot-reset-success");

});





?>
