<?php

use \Click\PageAdmin;
use \Click\Model\UserAdmin;

$app->get('/admin/users', function(){

	UserAdmin:: verifyLogin();

	$users = UserAdmin::listAll();

	$page = new PageAdmin();
	$page->setTpl("users", array(
		"users"=>$users

	));
});

$app->get('/admin/users/create', function(){

	UserAdmin:: verifyLogin();

	$page = new PageAdmin();
	$page->setTpl("users-create");
});

$app->get('/admin/users/:iduser/delete', function($iduser){

	UserAdmin:: verifyLogin();

	$user = new UserAdmin();

	$user->get((int)$iduser);
	$user->delete();
	header("Location: /admin/users");
	exit;
});

$app->get('/admin/users/:iduser',function($iduser){
UserAdmin::verifyLogin();	
$user = new UserAdmin();	
$user->get((int) $iduser);	$page = new PageAdmin();	
$page->setTpl("users-update", array(
"user"=>$user->getValues()	
	));

}); 

$app->post('/admin/users/create', function(){

	UserAdmin::verifyLogin();

	$user = new UserAdmin();

 	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

 	$_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [

 		"cost"=>12

 	]);

 	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
 	exit;
});

$app->post('/admin/users/:iduser', function($iduser){

	UserAdmin:: verifyLogin();

	$user = new UserAdmin();

	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;

});


?>