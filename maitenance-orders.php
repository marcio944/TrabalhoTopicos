<?php

use \Click\pageMaitenance;
use \Click\Model\Usermaitenance;
use \Click\Model\Order;
use \Click\Model\OrderStatus;

$app->get("/maitenance/orders/:idorder/status", function($idorder){

	Usermaitenance::verifyLogin();

	$order = new Order();

	$order->get((int)$idorder);

	$page = new pageMaitenance();

	$page->setTpl("order-status", [
		'order'=>$order->getValues(),
		'status'=>OrderStatus::listAll(),
		'msgSuccess'=>Order::getSuccess(),
		'msgError'=>Order::getError()
	]);


});

$app->post("/maitenance/orders/:idorder/status", function($idorder){

	Usermaitenance::verifyLogin();

	if (!isset($_POST['idstatus']) || !(int)$_POST['idstatus'] > 0) {
		Order::setError("Informe o status atual.");
		header("Location: /maitenance/orders/".$idorder."/status");
		exit;
	}

	$order = new Order();

	$order->get((int)$idorder);

	$order->setidstatus((int)$_POST['idstatus']);

	$order->save();

	Order::setSuccess("Status atualizado.");

	header("Location: /maitenance/orders/".$idorder."/status");
	exit;

});

$app->get("/maitenance/orders/:idorder/delete", function($idorder){

	Usermaitenance::verifyLogin();

	$order = new Order();

	$order->get((int)$idorder);

	$order->delete();

	header("Location: /maitenance/orders");
	exit;

});

$app->get("/maitenance/orders/:idorder", function($idorder){

	Usermaitenance::verifyLogin();

	$order = new Order();

	$order->get((int)$idorder);

	$cart = $order->getCart();

	$page = new pageMaitenance();

	$page->setTpl("order", [
		'order'=>$order->getValues(),
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts()
	]);

});

$app->get("/maitenance/orders", function(){

	Usermaitenance::verifyLogin();

	$page = new pageMaitenance();

	$page->setTpl("orders", [
		"orders"=>Order::listAll()
	]);

});

?>