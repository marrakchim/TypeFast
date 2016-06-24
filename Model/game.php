<?php


Class Game {

public static $table_name = "game";

public static function create($label, $game_text){

	$var = R::dispense(Game::$table_name);
	$var->label = $label;
	$var->text = $game_text;
	$var->status = 0;
	$var->difficulty = 0;
	//$theDate = date('Y-m-d H:i');
	//$var->user_date_register = $theDate;
	R::store( $var );
}

public static function setUserData($elemen_uuid, $elem_name, $elem_value){
if (Game::exists($elemen_uuid)){
$var = Game::findOneById($elemen_uuid);
$var[$elem_name]=$elem_value;
R::store( $var );
}
}

public static function getUserData($elemen_uuid, $elem_name){
if (Game::exists($elemen_uuid)){
$var = Game::findOneById($elemen_uuid);
return $var[$elem_name];
}
}

public static function findOneById($elemen_uuid){
$var =  R::findOne(Game::$table_name , ' element_id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_Games(){
return R::findAll(Game::$table_name);
}

public static function exists($elemen_uuid){
$var =  R::findOne(Game::$table_name , ' element_id = ? ', [ $elemen_uuid ] );
return $var != NULL;
}

public static function delete($elemen_uuid){
if (Game::exists($elemen_uuid)) {
R::trash( Game::findOneById($elemen_uuid) );
}
}

}
?>
