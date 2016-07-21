<?php

	require 'init.php';

	if (isset($_SESSION['id']) && $_SESSION['id'] != NULL && $_SESSION['id'] != ''){
		if ($_SESSION['admin']) {
			header('location:adminHome.php');
		}
		else header('location:userHome.php');
	}else {
		header('location:login.php');
	}

 ?>
