<?php
	error_reporting(-1);

	  include_once 'rb.php';
    R::setup('mysql:host=127.0.0.1;dbname=jeu','root','');
    R::setAutoResolve( TRUE );
    $post = R::dispense( 'post' );
    $post->text = 'Hello World';
    $id = R::store( $post );



		echo "here";

		      //Create or Update
    //$post = R::load( 'post', $id );   //Retrieve
    //R::trash( $post );                //Delete

		require 'rb.php';
	R::setup('mysql:host=localhost;dbname=jeu','root','');


	//$post1 = R::dispense( 'post' );
	//$post1->text = 'Hello World';
	//$post1->text2 = 'Hello World';

	//$id1 = R::store( $post1 );


	//$post = R::load( 'post', 3 );


	//$post->text = "non  :D" ;

	//R::store( $post );


	//$user = R::dispense('user');
	//$user->first_name = "Ahmed" ;
	//$user->last_name = "Saidi" ;
	//R::store( $user );



$user = R::load( 'user', 1 );
$user->first_name = "Hello" ;
R::store( $user );

var_dump($user);

R::trash( $user );


		 ?>
