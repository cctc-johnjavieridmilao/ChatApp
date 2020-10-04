<?php
include 'conn.php';

Class ChatApp extends Connection {

	private $connection;

	public function __construct() {
		$this->connection = $this->DBConnect();
	}

	public function InsertData($query, $data = array()) {
       $stmt = $this->connection->prepare($query);

       return $stmt->execute($data);
	}

	public function ReadData($query, $param = '') {
		$stmt = $this->connection->prepare($query);
		$stmt->execute($param);

		return $stmt->fetchAll();
	}

	public function Register($username,$password) {
		$query = "INSERT INTO tbl_users(Username,Password,CreateAt) VALUES (:Username,:Password,:CreateAt)";
		$pass = md5($password);

		$data = array(
			':Username' => $username,
			':Password' => $pass,
			':CreateAt' => date('Y-m-d'),
		);

		$stmt = $this->InsertData($query, $data);

		if ($stmt) {
			return 'success';
		} else {
			return $this->connection->errorInfo();
		}
	}

	public function Login($username,$password) {
		$query = "SELECT * FROM tbl_users WHERE Password = :password AND Username = :username LIMIT 1";

		$stmt = $this->ReadData($query, [
			':password' => md5($password),
			':username' => $username
		]);

		if (count($stmt) > 0) {
			return $stmt;
		} else {
			return 'error';
		}
	}

	public function SaveChat($sender,$receiver,$msg) {
		$query = "INSERT INTO tbl_chat(SenderID,RecieverID,Msg,Date) VALUES (:SenderID,:RecieverID,:Msg,:date)";

		$stmt = $this->InsertData($query, [
			':SenderID'   => $sender,
			':RecieverID' => $receiver,
			':Msg'        => $msg,
			':date'       => date('Y-m-d H:i:s')
		]);

		if ($stmt) {
			echo 'success';
		}
	}

	public function GetUsers($u_id,$str) {

		if (empty($str)) {
			$query = "SELECT * FROM tbl_users WHERE RecID != :RecID";
			$param = [
				 ':RecID' => $u_id
			];
		} else {
			$query = "SELECT * FROM tbl_users WHERE RecID != :RecID AND Username LIKE :username";

			$param = [
				 ':RecID'    => $u_id,
				 ':username' => '%'.$str.'%'
			];
		}

		
		$stmt = $this->ReadData($query, $param);

		if (count($stmt) > 0) {
			return $stmt;
		} else {
			return 'Error';
		}

	}

	public function GetUserName($u_id) {

		$query = "SELECT * FROM tbl_users WHERE RecID = :RecID";

		$stmt = $this->ReadData($query, [
			':RecID' => $u_id
		]);

		if (count($stmt) > 0) {
			return $stmt[0]['Username'];
		} else {
			return 'Error';
		}

	}

	public function GetChat($sender,$receiver) {

		$query = "SELECT X.SenderID,X.RecieverID,U.Username Sendername,UU.Username Receivername,x.Msg,x.Date 
			 FROM tbl_chat X 
				 INNER JOIN tbl_users U ON X.SenderID = U.RecID
				 INNER JOIN tbl_users UU ON X.RecieverID = UU.RecID
			 WHERE (X.SenderID = :sender AND X.RecieverID = :receiver) 
			 OR (X.SenderID = :receiver AND X.RecieverID = :sender)";

		$stmt = $this->ReadData($query, [
			':sender'   => $sender,
			':receiver' => $receiver
		]);

		if (count($stmt) > 0) {
			return $stmt;
		} else {
			return ['Error' => 'Error'];
		}

	}
}

$ChatApp = new ChatApp();
//echo var_dump($ChatApp->GetChat(1,2));