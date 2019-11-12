<?php

use \Click\PageAdmin;
use \Click\Model\UserAdmin;

$app->get('/admin', function() {
    

	UserAdmin:: verifyLogin();

    $page = new PageAdmin();
	$page->setTpl("index");

});
$app->get('/admin/login', function() {

  $page = new PageAdmin([
    "header"=>false,
    "footer"=>false
  ]);

  $page->setTpl("login",[

    'error'=>UserAdmin::getError(),
    'errorRegister'=>UserAdmin::getErrorRegister(),
    'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues']: ['name'=>'', 'email'=>'','phone'=>'']

  ]);

});

$app->post('/admin/login', function() {

try{
  UserAdmin::login($_POST["login"], $_POST["password"]);
}catch(Exception $e){

    UserAdmin::setError($e->getMessage());
  }
  header("Location: /admin");
  exit;

});

$app->get('/admin/logout', function() {
    
   UserAdmin::logout();

   header("Location: /admin/login");
   exit;

});

$app->get('/admin/forgot', function() {
    
    $page = new PageAdmin([

      "header" => false,
      "footer" =>false

    ]);
     $page->setTpl("forgot");

});

$app->post('/admin/forgot', function() {
    
  $user = UserAdmin::getForgot($_POST["email"]);  
  header("Location: /admin/forgot/sent");
  exit;

});

$app->get('/admin/forgot/sent', function() {
    
   $page = new PageAdmin([

      "header" => false,
      "footer" =>false

    ]);
     $page->setTpl("forgot-sent");

});

$app->get('/admin/forgot/reset', function() {

  $user = UserAdmin::validForgotDecrypt($_GET["code"]);
    
   $page = new PageAdmin([

      "header" => false,
      "footer" =>false
    ]);

     $page->setTpl("forgot-reset", array(

      "name"=>$user["desperson"],
      "code"=>$_GET["code"]
  
     ));

});

$app->post("/admin/forgot/reset", function(){

  $forgot = UserAdmin::validForgotDecrypt($_POST["code"]);

  UserAdmin::setFogotUsed($forgot["idrecovery"]);

  $user = new User();

  $user->get((int) $forgot["iduser"]);

  $options = [
    'cost' => 12,
  ];

  $password = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);

  $user->setPassword($password);

  $page = new PageAdmin([

      "header" => false,
      "footer" =>false
    ]);

     $page->setTpl("forgot-reset-success");

});

?>
