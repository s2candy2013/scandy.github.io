<?php 
function getConnect()
{
	try{
		$connect = new PDO("mysql:host=sql113.byethost.com;dbname=b7_23270826_testsofa;charset=utf8","b7_23270826","2951999");
		return $connect;
	}catch(Exception $ex){
		echo "Kết nối CSDL không thành công";die;
	}
}
function run($sqlQuery, $getAll = false)
{	
	$conn = getConnect();
	$stmt = $conn ->prepare($sqlQuery);
	$stmt->execute();
	if ($getAll) {
		return $stmt ->fetchAll();
	}else{
		return $stmt ->fetch();
	}
}
 ?>