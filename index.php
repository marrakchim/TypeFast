<?php

require 'init.php';

if (!isset($_SESSION['id'])){
		header('location:login.php');
}else {
		if ($_SESSION['admin']) {
			header('location:adminHome.php');
		}
		else header('location:userHome.php');
}


 ?>
