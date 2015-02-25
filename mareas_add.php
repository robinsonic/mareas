<?php include('Connections/connect.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO mareas (dia, primera_pleamar, segunda_pleamar, primera_bajamar, segunda_bajamar) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['dia'], "text"),
                       GetSQLValueString($_POST['primera_pleamar'], "text"),
                       GetSQLValueString($_POST['segunda_pleamar'], "text"),
                       GetSQLValueString($_POST['primera_bajamar'], "text"),
					   GetSQLValueString($_POST['segunda_bajamar'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "mareas_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connect, $connect);
$query_Recordset1 = "SELECT * FROM mareas ORDER BY mareas.dia ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Administrar mareas</title></head>
<body>

<script>
  function validarNumero(numero){
  
   if (!/^([0-9])(.+)*$/.test(numero))
      alert("El valor " + numero + " no es un numero");
  }
 
</script>

   <h1>A&ntilde;adir Mareas </h1>
   <p>&nbsp;</p>
  
   
   <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Dia:</td>
          <td><input type="text" name="dia" value="" size="32" placeholder="dd mes" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Primera pleamar:</td>
          <td><input type="text" name="primera_pleamar" value="" size="32" placeholder="00.00" onChange="validarNumero(this.value)" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Segunda pleamar:</td>
          <td><input type="text" name="segunda_pleamar" value="" size="32" placeholder="00.00" onChange="validarNumero(this.value)" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Primera bajamar:</td>
          <td><input type="text" name="primera_bajamar" value="" size="32" placeholder="00.00" onChange="validarNumero(this.value)" required></td>
        </tr>
        <tr valign="baseline">
           <td nowrap align="right">Segunda bajamar:</td>
          <td><input type="text" name="segunda_bajamar" value="" size="32" placeholder="00.00" onChange="validarNumero(this.value)" required></td>
        </tr>
    
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar Marea"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable -->  </div>
</div>
<!--end content -->

</body>
</html>