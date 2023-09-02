<?php
$conn = mysqli_connect("localhost", "root", "", "chatapp");
$result = mysqli_query($conn, "SELECT * FROM users");
 
$data = array();
while ($row = mysqli_fetch_object($result))
{
    //array_push($data, $row);
    $data[]=$row;
}
 //returning result in json format

echo json_encode($data);
exit();