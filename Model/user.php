<?php


Class User {

public static $table_name = "user";

public static function create($elemen_uuid, $user){

	if (!User::exists($elemen_uuid)) {

	  $var = R::dispense(User::$table_name);

	  $var->element_uuid = uniqid();
	  $var->login = $user['login'];
	  $var->password= hash('sha256', $user['password']);
		$var->nom = $user['nom'];
		$var->prenom = $user['prenom'];
		$var->mail = $user['mail'];

	  $var->admin=$user['admin'];
	  R::store( $var );
		return $var;
	}

}

public static function setUserData($elemen_uuid, $elem_name, $elem_value){
if (User::exists($elemen_uuid)){
$var = User::findOneById($elemen_uuid);
$var[$elem_name]=$elem_value;
R::store( $var );
}
}
public static function getUserData($elemen_uuid, $elem_name){
if (User::exists($elemen_uuid)){
$var = User::findOneById($elemen_uuid);
return $var[$elem_name];
}
}

public static function findOneById($elemen_uuid){
$var =  R::findOne(User::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_User(){
return R::findAll(User::$table_name);
}

public static function exists($elemen_uuid){
$var =  R::findOne(User::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var != NULL;
}

public static function delete($elemen_uuid){
if (User::exists($elemen_uuid)) {
R::trash( User::findOneById($elemen_uuid) );
}
}


/******************/

public static function connect($login, $pass){
$pass = hash('sha256', $pass);
$var = R::findOne(User::$table_name , ' login = ? and password = ? ', [ $login, $pass ] );
if ($var != NULL) {
return $var;
}else {
return false;
}
}
}
?>
