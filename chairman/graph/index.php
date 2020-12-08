<?php 

header("Content-type: application/json");

$data = array(

array("Week"=>"Week 1", "score"=>95),
array("Week"=>"Week 2", "score"=>66),
array("Week"=>"Week 3", "score"=>56),
array("Week"=>"Week 4", "score"=>95),
array("Week"=>"Week 5", "score"=>54),
array("Week"=>"Week 6", "score"=>38),
array("Week"=>"Week 7", "score"=>40),
array("Week"=>"Week 8", "score"=>50),
array("Week"=>"Week 9", "score"=>40),
array("Week"=>"Week 10", "score"=>10),
array("Week"=>"Week 11", "score"=>6),
array("Week"=>"Week 12", "score"=>0),
array("Week"=>"Week 13", "score"=>0),
array("Week"=>"Week 14", "score"=>0),
array("Week"=>"Week 15", "score"=>0),
array("Week"=>"Week 16", "score"=>0),
array("Week"=>"Week 17", "score"=>0),
array("Week"=>"Week 18", "score"=>0),
);

echo json_encode($data);

 ?>

