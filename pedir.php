
<?php
include("db2.php");
foreach($_POST as $n => $v) $$n = $mysqli->real_escape_string($v); //strip_tags()

$ip = $_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO pedir (dorigen, torigen, ddestino, tdestino, ip) VALUES ('$dorigen','$torigen','$ddestino','$tdestino','$ip');";
$mysqli->query($sql) or  print($mysqli->error);

?>
