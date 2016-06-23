<?php


Class Game {

public static $table_name = "game";

public static function create($game_text,$game_idUser){

$var = R::dispense(Game::$table_name);
$var->element_id = uniqid();
$var->text = $game_text;
$var->idUser= $game_idUser;

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

public static function findAll_User(){
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
