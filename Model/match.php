<?php

Class Match {

public static $table_name = "match";

public static function create($match_idUser, $match_idGame){

$var = R::dispense(Match::$table_name);
$var->nbTry = 1;
$var->idUser= $match_idUser;
$var->idGame=$match_idGame;
$var->timeStart=  date('Y-m-d H:i:s');
$var->score=0;
$var->timePlayed=300;
$var->timeEnd=-1;
 R::store( $var );
return $var->id;
}

public static function setMatchData($elemen_uuid, $elem_name, $elem_value){
if (Match::exists($elemen_uuid)){
$var = Match::findOneById($elemen_uuid);
$var[$elem_name]=$elem_value;
R::store( $var );
}
}

public static function getMatchData($elemen_uuid, $elem_name){
if (Match::exists($elemen_uuid)){
$var = Match::findOneById($elemen_uuid);
return $var[$elem_name];
}
}

public static function findOneById($elemen_uuid){
$var =  R::findOne(Match::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_Matches(){
return R::findAll(Match::$table_name);
}

public static function findLastOneByUserID_gameID($user_id,$game_id)
{
  $var = R::findLast(Match::$table_name, 'id_user = ? and id_game = ?', [$user_id,$game_id]);
  //$var = R::findOne(Match::$table_name, 'id_user = ? and id_game = ? ORDER BY nb_try DESC', [$user_id,$game_id]);
  return $var;
}

public static function exists($elemen_uuid){
$var =  R::findOne(Match::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var != NULL;
}

public static function delete($elemen_uuid){
if (Match::exists($elemen_uuid)) {
R::trash( Match::findOneById($elemen_uuid) );
}
}

}






?>
