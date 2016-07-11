<?php


Class Game {

public static $table_name = "game";

public static function create($label, $game_text,$game_difficulty){

	$var = R::dispense(Game::$table_name);
	$var->label = $label;
	$var->text = $game_text;
	$var->status = 0;
	$var->difficulty = $game_difficulty;
	return R::store( $var );
}

public static function setGameData($elemen_uuid, $elem_name, $elem_value){
if (Game::exists($elemen_uuid)){
$var = Game::findOneById($elemen_uuid);
$var[$elem_name]=$elem_value;
R::store( $var );
}
}

public static function getGameData($elemen_uuid, $elem_name){
if (Game::exists($elemen_uuid)){
$var = Game::findOneById($elemen_uuid);
return $var[$elem_name];
}
}

public static function findOneById($elemen_uuid){
$var =  R::findOne(Game::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_Games(){
return R::findAll(Game::$table_name);
}

public static function exists($elemen_uuid){
$var =  R::findOne(Game::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var != NULL;
}

public static function delete($elemen_uuid){
if (Game::exists($elemen_uuid)) {
R::trash( Game::findOneById($elemen_uuid) );
}
}

}
?>
