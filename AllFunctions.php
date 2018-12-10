<?php

class AllFunctions{


function grouping($array){
$parents = array();
$childrens = array();
$result = array();
$rows = array();

   if($array){
      while($row = $array->fetch_assoc()){
         $rows[] = $row;
      }
   }

	foreach ($rows as $val){

		if($val['parent_id']==0){
			$parents[]= $val;
		}
			foreach ($parents as $parent) {

			if($val['parent_id'] == $parent['id']){
				$childrens[]=$val;

				for($i=0; $i<count($childrens); $i++){
					if(array_key_exists($i, $childrens)){
						if($childrens[$i]['parent_id']!=$parent['id']){
						unset($childrens[$i]);
						}
					}
				}
			$result[$parent['title']] = array("title" =>$parent['title'], "children" => $childrens);
			}
		}
	}
	return array_values($result);
}


function levels($array){
   $stringOfLevels = array();

   while($row = $array->fetch_assoc()){
      
         if($row['parent_id']==0){
            $stringOfLevels[] = ["title" => $row['title'], "level" => '1'];
         }else{
            $stringOfLevels[] = ["title" => $row['title'], "level" => '2'];
         }
   }
   return $stringOfLevels;
}



}
?>