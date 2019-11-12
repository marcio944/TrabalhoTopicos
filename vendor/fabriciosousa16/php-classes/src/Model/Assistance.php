<?php

namespace Click\Model;

use \Click\DB\Sql_2;
use \Click\Model;
use \Click\Mailer;

class Assistance extends Model{

	const SESSION = "User";
	const SECRET = "ProjetoSistemas2";
	const ERROR = "userError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

		public static function getFromSession(){

		$user = new UserAdmin();

		if (isset($_SESSION[UserAdmin::SESSION]) && (int)$_SESSION[UserAdmin::SESSION]['iduser'] > 0) {

			$user->setData($_SESSION[UserAdmin::SESSION]);

		}

		return $user;

	}

	public static function checkLogin($inadmin = true){

		if (
			!isset($_SESSION[UserAdmin::SESSION])
			||
			!$_SESSION[UserAdmin::SESSION]
			||
			!(int)$_SESSION[UserAdmin::SESSION]["iduser"] > 0
		) {
			return false;

		} else {

			if ($inadmin === true && (bool)$_SESSION[UserAdmin::SESSION]['inadmin'] === true) {

				return true;

			} else if ($inadmin === false) {

				return true;

			} else {

				return false;

			}

		}

	}

	public static function login($login, $password){

		$sql = new Sql_3();

		$results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b ON a.idperson = b.idperson WHERE a.deslogin = :LOGIN", array(
			":LOGIN"=>$login
		)); 


		if (count($results) === 0){
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true)
		{

			$user = new UserAdmin();

			$data['desperson'] = utf8_encode($data['desperson']);

			$user->setData($data);

			$_SESSION[UserAdmin::SESSION] = $user->getValues();

			return $user;

		} else {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

	}

	public static function verifyLogin($inadmin = true){

		if (!UserAdmin::checkLogin($inadmin)) {

			if ($inadmin) {
				header("Location: /admin/login");
			} else {
				header("Location: /login");
			}
			exit;

		}

	}

	public static function logout(){

		$_SESSION[UserAdmin::SESSION] = NULL;

	}
	public static function listAll(){

		$sql = new Sql_3();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");

	}

	public function save(){

		$sql = new Sql_2();

		$results = $sql->select("CALL sp_assistance_save(:desname, :description,:desnameproduct, :desemail, :nrphone, :instatus)", array(
			":desname"=>utf8_decode($this->getdesname()),
			":description"=>utf8_decode($this->getdescription()),
			":desnameproduct"=>utf8_decode($this->getdesnameproduct()),
			":desemail"=>$this->getdesemail(),
			":nrphone"=>$this->getnrphone(),
			":instatus"=>$this->getinstatus()
		));

		$this->setData($results[0]);

	}

	public function get($idassistance){

		$h = new Sql_2();

		$results = $sql->select("SELECT * FROM tb_assistance a INNER JOIN tb_persons_assistance b USING(idname) WHERE a.idassistance = :idassistance", array(
			":idassistance"=>$iidassistance
		));

		$data = $results[0];

		$data['desname'] = utf8_encode($data['desname']);


		$this->setData($data);

	}

	public function update(){

		$sql = new Sql_3();

		$results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
			":iduser"=>$this->getiduser(),
			":desperson"=>utf8_decode($this->getdesperson()),
			":deslogin"=>$this->getdeslogin(),
			":despassword"=>UserAdmin::getPasswordHash($this->getdespassword()),
			":desemail"=>$this->getdesemail(),
			":nrphone"=>$this->getnrphone(),
			":inadmin"=>$this->getinadmin()
		));

		$this->setData($results[0]);		

	}

	public function delete(){

		$sql = new Sql_3();

		$sql->query("CALL sp_users_delete(:iduser)", array(
			":iduser"=>$this->getiduser()
		));

	}


	public static function getForgot($email, $inadmin = true){

		$sql = new Sql_3();

		$results = $sql->select("
			SELECT *
			FROM tb_persons a
			INNER JOIN tb_users b USING(idperson)
			WHERE a.desemail = :email;
		", array(
			":email"=>$email
		));

		if (count($results) === 0){
			throw new \Exception("Não foi possível recuperar a senha.");
			
		}
		else {

			$data = $results[0];

			$results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)", array(
				":iduser"=>$data["iduser"],
				":desip"=>$_SERVER["REMOTE_ADDR"]
			));

			if (count($results2) === 0){

				throw new \Exception("Não foi possível recuperar a senha");

			}
			else{

				$dataRecovery = $results2[0];

				$code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, UserAdmin::SECRET, $dataRecovery["idrecovery"], MCRYPT_MODE_ECB));

				if ($inadmin === true) {
					
					$link = "http://clickvendas.azurewebsites.net/admin/forgot/reset?code=$code";

				} else {

					$link = "http://clickvendas.azurewebsites.net/forgot/reset?code=$code";

				}


				$mailer = new Mailer($data["desemail"], $data["desperson"], "Redefinir Senha  Click Vendas", "forgot", array(
					"name"=>$data["desperson"],
					"link"=>$link
				));

				$mailer->send();

				return $data;

			}


		}

	}

	public static function validForgotDecrypt($code){

		$idrecovery = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, UserAdmin::SECRET, base64_decode($code), MCRYPT_MODE_ECB);

		$sql = new Sql_3();

		$results = $sql->select("
			SELECT * 
			FROM tb_userspasswordsrecoveries a
			INNER JOIN tb_users b USING(iduser)
			INNER JOIN tb_persons c USING(idperson)
			WHERE 
				a.idrecovery = :idrecovery
			    AND
			    a.dtrecovery IS NULL
			    AND
			    DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
		", array(
			":idrecovery"=>$idrecovery
		));

		if (count($results) === 0){
			throw new \Exception("Não foi possível recuperar a senha.");
		}
		else{

			return $results[0];

		}

	}

	public static function setFogotUsed($idrecovery){

		$sql = new Sql_3();

		$sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(
			":idrecovery"=>$idrecovery
		));

	}


	public function setPassword($password){

		$sql = new Sql_3();

		$sql->query("UPDATE tb_users SET despassword = :password WHERE iduser = :iduser", array(
			":password"=>$password,
			":iduser"=>$this->getiduser()
		));

	}

	public static function setError($msg){

		$_SESSION[UserAdmin::ERROR] = $msg;

	}

	public static function getError(){

		$msg = (isset($_SESSION[UserAdmin::ERROR]) && $_SESSION[UserAdmin::ERROR]) ? $_SESSION[UserAdmin::ERROR] : '';

		UserAdmin::clearError();

		return $msg;

	}

	public static function clearError(){

		$_SESSION[UserAdmin::ERROR] = NULL;

	}

	public static function setSuccess($msg)	{

		$_SESSION[UserAdmin::SUCCESS] = $msg;

	}

	public static function getSuccess(){

		$msg = (isset($_SESSION[UserAdmin::SUCCESS]) && $_SESSION[UserAdmin::SUCCESS]) ? $_SESSION[UserAdmin::SUCCESS] : '';

		UserAdmin::clearSuccess();

		return $msg;

	}

	public static function clearSuccess(){

		$_SESSION[UserAdmin::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg){

		$_SESSION[UserAdmin::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister(){

		$msg = (isset($_SESSION[UserAdmin::ERROR_REGISTER]) && $_SESSION[UserAdmin::ERROR_REGISTER]) ? $_SESSION[UserAdmin::ERROR_REGISTER] : '';

		UserAdmin::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister(){

		$_SESSION[UserAdmin::ERROR_REGISTER] = NULL;

	}

	public static function checkLoginExist($login){

		$sql = new Sql_3();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin", [
			':deslogin'=>$login
		]);

		return (count($results) > 0);

	}

	public static function getPasswordHash($password){

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

	public function getOrders(){

		$sql = new Sql_3();

		$results = $sql->select("
			SELECT * 
			FROM tb_orders a 
			INNER JOIN tb_ordersstatus b USING(idstatus) 
			INNER JOIN tb_carts c USING(idcart)
			INNER JOIN tb_users d ON d.iduser = a.iduser
			INNER JOIN tb_addresses e USING(idaddress)
			INNER JOIN tb_persons f ON f.idperson = d.idperson
			WHERE a.iduser = :iduser
		", [
			':iduser'=>$this->getiduser()
		]);

		return $results;

	}
	
}

?>