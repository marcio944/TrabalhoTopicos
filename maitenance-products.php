<?php 

use \Click\pageMaitenance;
use \Click\Model\userMaitenance;
use \Click\Model\ProductMaitenance;

$app->get('/maitenance/products', function(){

	userMaitenance:: verifyLogin();

	$maitenance = ProductMaitenance::listAll();

	$page = new pageMaitenance();

	$page ->setTpl("products", array(
		"maitenance"=>$maitenance
	));
});

 
$app->get('/maitenance/products/:iduser',function($idassistance){
	
	userMaitenance::verifyLogin();	
	
	$maitenance = new ProductMaitenance();	
	
	$maitenance->get((int) $idassistance);	
	
	$page = new pageMaitenance();	
	
	$page->setTpl("products-update", array(
	
	"maitenance"=>$maitenance->getValues()	
	
	));

});


$app->get('/maitenance/products/:idproduct/delete', function($idassistance){

	userMaitenance:: verifyLogin();

	$product = new ProductMaitenance();

	$product->get((int)$idassistance);

	$product->delete();

	header("Location: /maitenance/products");
	exit;

	
}); 

 ?>