<?php
session_start();
$lang = "es"; 

if(isset($_SESSION['lang'])) $lang = $_SESSION['lang'];

if(!isset($_SESSION['lang']))
{
	switch (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)){
	    case "es":
	        $lang = "es"; 
	        break;
	    case "en":
			$lang = "en"; 
	        break;
	    case "fr":
			$lang = "fr"; 
	        break;        
	}
}

if(isset($_GET['lang'])) $lang = $_GET['lang'];
include("inc/lang/$lang.php");


$_SESSION['lang'] = $lang;
?>