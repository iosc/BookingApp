<?
//ob_start('ob_gzhandler');
session_start();
$srvipaddress = $_SERVER['HTTP_HOST'];
//echo $srvipaddress;
//if ($srvipaddress = "80.249.98.42")
if ($srvipaddress == "localhost" || $srvipaddress == "localhost:8081" )
{
	require_once("config_local.php");
} else {
	include('config.php');
}

include('includes/functions.php');

?>
