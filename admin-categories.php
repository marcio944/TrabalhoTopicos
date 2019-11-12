<?php

use \Click\PageAdmin;
use \Click\Model\UserAdmin;
use \Click\Model\Category;
use \Click\Model\Product;


$app->get("/admin/categories", function(){

	UserAdmin:: verifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin();
	$page->setTpl("categories",['categories'=>$categories]);

});

$app->get("/admin/categories/create", function(){

	UserAdmin:: verifyLogin();

	$page = new PageAdmin();
	$page->setTpl("categories-create");
});

$app->post("/admin/categories/create", function(){

	UserAdmin:: verifyLogin();

	$category = new Category();
	$category->setData($_POST);
	$category->save();

	header("Location: /admin/categories");
	exit;
});

$app->get("/admin/categories/:idcategory/delete", function($idcategory){

	UserAdmin:: verifyLogin();

	$category = new Category();
	$category->get((int)$idcategory);
	$category->delete();

	header("Location: /admin/categories");
	exit;
});

$app->get("/admin/categories/:idcategory", function($idcategory){

	UserAdmin:: verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update",[ "category"=>$category->getValues()]);

});

$app->post("/admin/categories/:idcategory", function($idcategory){

	UserAdmin:: verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");
	exit;
});

$app->get("/admin/categories/:idcategory/products", function($idcategory){

	UserAdmin:: verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin(); 

	$page->setTpl("categories-products", [
	"category"=>$category->getValues(),
	"productsRelated"=>$category->getProducts(),
	"productsNotRelated"=>$category->getProducts(false)
]);

});

$app->get("/admin/categories/:idcategory/products/:idproduct/add", function($idcategory, $idproduct){

	UserAdmin::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$product = new Product();

	$product->get((int)$idproduct);

	$category->addProduct($product);

	header("Location: /admin/categories/".$idcategory."/products");
	exit;

});

$app->get("/admin/categories/:idcategory/products/:idproduct/remove", function($idcategory, $idproduct){

	UserAdmin::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$product = new Product();

	$product->get((int)$idproduct);

	$category->removeProduct($product);

	header("Location: /admin/categories/".$idcategory."/products");
	exit;

});

?>
