<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Xác nhận email</title>
</head>
<body>
<?php
require_once "db.php";
 
// kiểm tra xem email đã tồn tại chưa
$query = "SELECT * FROM users WHERE verification_code = ? and verified = '0'";
$conn = getConnect();
$stmt = $conn->prepare( $query );
$stmt->bindParam(1, $_GET['code']);
$stmt->execute();
$num = $stmt->rowCount();
 
if($num>0){
 
    // update the 'verified' field, from 0 to 1 (unverified to verified)
    $query = "UPDATE users
                set verified = '1'
                where verification_code = :verification_code";
 
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':verification_code', $_GET['code']);
 
    if($stmt->execute()){
        header( "refresh:5;url=signin.php" );

        echo "<div>Your email is valid, thanks!. You may <a href='signin.php'>login now</a> or wait 5 seconds.</div>";
    }else{
        echo "<div>Unable to update verification code.</div>";
        //print_r($stmt->errorInfo());
    }
 
}else{
    // tell the user he should not be in this page
    echo "<div>We can't find your verification code.</div>";
}
?>
</body>
</html>