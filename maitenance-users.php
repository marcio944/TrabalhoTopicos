<?php

use \Click\PageMaitenance;
use \Click\Model\UserMaitenance;


$app->get('/maitenance/users', function(){

	UserMaitenance:: verifyLogin();

	$users = UserMaitenance::listAll();

	$page = new PageMaitenance();
	$page->setTpl("users", array(
		"users"=>$users

	));
});

$app->get('/maitenance/users/create', function(){

	UserMaitenance:: verifyLogin();

	$page = new PageMaitenance();
	$page->setTpl("users-create");
});

$app->get('/maitenance/users/:iduser/delete', function($iduser){

	UserMaitenance:: verifyLogin();

	$user = new UserMaitenance();

	$user->get((int)$iduser);
	$user->delete();
	header("Location: /maitenance/users");
	exit;
});

$app->get('/maitenance/users/:iduser',function($iduser){
UserMaitenance::verifyLogin();	
$user = new UserMaitenance();	
$user->get((int) $iduser);	
$page = new Pagemaitenance();	
$page->setTpl("users-update", array(
"user"=>$user->getValues()	
	));

}); 

$app->post('/maitenance/users/create', function(){

	UserMaitenance::verifyLogin();

	$user = new UserMaitenance();

 	$_POST["inmaitenance"] = (isset($_POST["inmaitenance"])) ? 1 : 0;

 	$_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [

 		"cost"=>12

 	]);

 	$user->setData($_POST);

	$user->save();

	header("Location: /maitenance/users");
 	exit;
});

$app->post('/maitenance/users/:iduser', function($iduser){

	UserMaitenance:: verifyLogin();

	$user = new UserMaitenance();

	$_POST["inmaitenance"] = (isset($_POST["inmaitenance"])) ? 1 : 0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /maitenance/users");
	exit;

});


?>