<?php
include 'ChatApp.php';
session_start();
error_reporting(0);
$ACTION = $_POST['ACTION'];

switch ($ACTION) {
	case 'REGISTER_USER':
		    $UserName = $_POST['Uname'];
		    $password = $_POST['password'];
		    $cpassword = $_POST['cpassword'];

		    if (empty($UserName) || empty($password) || empty($cpassword)) {
		    	echo json_encode(['error' => 'Please Fill Out All Fields!']);
		    	return;
		    }

		    if ($password != $cpassword) {
		    	echo json_encode(['error' => 'Password and Confirm Password Not Match!']);
		    	return;
		    }

		    $res = $ChatApp->Register($UserName, $password);

		    echo json_encode(['success' => $res]);

		break;
	case 'LOGIN_USER':
		    $UserName = $_POST['Uname'];
		    $password = $_POST['password'];

		    if (empty($UserName) || empty($password)) {
		    	echo json_encode(['error' => 'Please Fill Out All Fields!']);
		    	return;
		    }

		    $res = $ChatApp->Login($UserName, $password);

		    if ($res != 'error') {

		    	$_SESSION['u_id'] = $res[0]['RecID'];

		    	 echo json_encode(['success' => 'success']);
		    } else {
		    	 echo json_encode(['error' => 'UserName and Password Not Exist!']);
		    }

		break;
	
	case 'SAVE_CHAT' :

	      $sender = $_POST['sender'];
	      $receiver = $_POST['receiver'];
	      $msg = $_POST['msg'];

	      $ChatApp->SaveChat($sender, $receiver, $msg);
		 
	    break;
	case 'GET_USERS' :
		 $u_id = $_SESSION['u_id'];
		 $str = $_POST['str'];
	     echo json_encode($ChatApp->GetUsers($u_id, $str));
	    break;
    case 'GET_CHATS' :
		 $receiver = $_POST['receiver'];
		 $sender = $_POST['sender'];
	     echo json_encode($ChatApp->GetChat($sender,$receiver));
	    break;
	case 'GET_CHAT_NAME' :
		 $receiver = $_POST['receiver'];
	     echo $ChatApp->GetUserName($receiver);
	    break;

	default:
		// code...
		break;
}