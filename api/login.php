<?php
include_once("../data.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
$pwd = mysqli_real_escape_string($mysqli, trim($request->pwd));
$email = mysqli_real_escape_string($mysqli, trim($request->email));
$sql = "SELECT * FROM users where email='$email' && password='$pwd'";
if($result = mysqli_query($mysqli,$sql))
{
$rows = array();
while($row = mysqli_fetch_assoc($result))
{
$rows[] = $row;
}
echo json_encode($rows[0]);
}
else
{
http_response_code(404);
}
}
?>