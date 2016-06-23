<?php


Class Match {

public static $table_name = "match";

public static function create($match_nbTry, $match_idUser, $match_idGame, $match_timePlay, $match_score){

$var = R::dispense(Match::$table_name);
$var->element_id = uniqid();
$var->nbTry = $match_nbTry;
$var->idUser= $match_idUser;
$var->idGame=$match_idGame;
$var->idGame=$match_timePlay;
$var->timePlay=$match_timePlay;
$var->score=$match_score;
//$theDate = date('Y-m-d H:i');
//$var->user_date_register = $theDate;
R::store( $var );


}

public static function setUserData($elemen_uuid, $elem_name, $elem_value){
if (Match::exists($elemen_uuid)){
$var = Match::findOneById($elemen_uuid);
$var[$elem_name]=$elem_value;
R::store( $var );
}
}

public static function getUserData($elemen_uuid, $elem_name){
if (Match::exists($elemen_uuid)){
$var = Match::findOneById($elemen_uuid);
return $var[$elem_name];
}
}

public static function findOneById($elemen_uuid){
$var =  R::findOne(Match::$table_name , ' element_id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_User(){
return R::findAll(Match::$table_name);
}

public static function exists($elemen_uuid){
$var =  R::findOne(Match::$table_name , ' element_id = ? ', [ $elemen_uuid ] );
return $var != NULL;
}

public static function delete($elemen_uuid){
if (Match::exists($elemen_uuid)) {
R::trash( Match::findOneById($elemen_uuid) );
}
}
}

?>
