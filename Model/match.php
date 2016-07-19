<?php

<<<<<<< HEAD
=======

>>>>>>> fa79d30878adec6f61b5ae0c52699e302207d26b
Class Match {

public static $table_name = "match";

<<<<<<< HEAD
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
=======
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
>>>>>>> fa79d30878adec6f61b5ae0c52699e302207d26b
if (Match::exists($elemen_uuid)){
$var = Match::findOneById($elemen_uuid);
$var[$elem_name]=$elem_value;
R::store( $var );
}
}

<<<<<<< HEAD
public static function getMatchData($elemen_uuid, $elem_name){
=======
public static function getUserData($elemen_uuid, $elem_name){
>>>>>>> fa79d30878adec6f61b5ae0c52699e302207d26b
if (Match::exists($elemen_uuid)){
$var = Match::findOneById($elemen_uuid);
return $var[$elem_name];
}
}

public static function findOneById($elemen_uuid){
<<<<<<< HEAD
$var =  R::findOne(Match::$table_name , ' id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_Matches(){
return R::findAll(Match::$table_name);
}

public static function findOnebyUserID_gameID($user_id,$game_id)
{
  $var = R::findLast(Match::$table_name, 'id_user = ? and id_game = ?', [$user_id,$game_id]);
  return $var;
}

public static function exists($elemen_uuid){
$var =  R::findOne(Match::$table_name , ' id = ? ', [ $elemen_uuid ] );
=======
$var =  R::findOne(Match::$table_name , ' element_id = ? ', [ $elemen_uuid ] );
return $var;
}

public static function findAll_User(){
return R::findAll(Match::$table_name);
}

public static function exists($elemen_uuid){
$var =  R::findOne(Match::$table_name , ' element_id = ? ', [ $elemen_uuid ] );
>>>>>>> fa79d30878adec6f61b5ae0c52699e302207d26b
return $var != NULL;
}

public static function delete($elemen_uuid){
if (Match::exists($elemen_uuid)) {
R::trash( Match::findOneById($elemen_uuid) );
}
}
}

?>
