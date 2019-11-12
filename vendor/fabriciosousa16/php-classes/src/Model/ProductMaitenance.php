<?php 

namespace Click\Model;

use \Click\DB\Sql_2;
use \Click\DB\Sql;
use \Click\Model;
use \Click\Mailer;

class ProductMaitenance extends Model {

	public static function listAll()
	{

		$sql = new Sql_2();

		return $sql->select("SELECT * FROM tb_assistance a INNER JOIN tb_persons_assistance b USING(idname) ORDER BY b.desname");

	}

	public static function checkList($list){

		foreach ($list as &$row) {
			
			$p = new ProductMaitenance();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}


	public function get($idassistance){

		$sql = new Sql_2();

		$results = $sql->select("SELECT * FROM tb_assistance a INNER JOIN tb_persons_assistance b USING(idname) WHERE a.idassistance = :idassistance", array(
			":idassistance"=>$idassistance
		));

		$this->setData($results[0]);

	}

	public function delete(){

		$sql = new Sql_2();

		$sql->query("CALL sp_assistance_delete(:idassistance)", array(
			":idassistance"=>$this->getidassistance()
		));

	} 
}

 ?>