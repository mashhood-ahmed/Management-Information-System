<?php 


header("Content-type: application/json");


$data = array(

array("playerid"=>"A", "score"=>7),
array("playerid"=>"A-", "score"=>6),
array("playerid"=>"B+", "score"=>5),
array("playerid"=>"B", "score"=>9),
array("playerid"=>"B-", "score"=>12),
array("playerid"=>"C+", "score"=>3),
array("playerid"=>"C", "score"=>4),
array("playerid"=>"C-", "score"=>1),
array("playerid"=>"D+", "score"=>2),
array("playerid"=>"D", "score"=>1),
array("playerid"=>"F", "score"=>6),
array("playerid"=>"W", "score"=>0),
array("playerid"=>"I", "score"=>0),
);

echo json_encode($data);

 ?>

