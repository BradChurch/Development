<?php error_reporting(E_ALL ^ E_DEPRECATED);?>
<?php require_once('../Connections/development.php'); ?>
<?php require_once('../Connections/swmisconn.php'); ?>
<?php if (session_status() == PHP_SESSION_NONE) { session_start(); }?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if ((isset($_GET['delid'])) && ($_GET['delid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM devphpdb WHERE id=%s",
                       GetSQLValueString($_GET['delid'], "int"));

  mysql_select_db($database_development, $development);
  $Result1 = mysql_query($deleteSQL, $development) or die(mysql_error());

  $deleteGoTo = "DevTrackEdit.php?id=".$_GET['devid'];
  header(sprintf("Location: %s", $deleteGoTo));
}
?>



