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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE mareas SET dia=%s, primera_pleamar=%s, segunda_pleamar=%s, primera_bajamar=%s, segunda_bajamar=%s WHERE id=$_POST[id]",
					   
                       GetSQLValueString($_POST['dia'], "text"),
                       GetSQLValueString($_POST['primera_pleamar'], "text"),
                       GetSQLValueString($_POST['segunda_pleamar'], "text"),
                       GetSQLValueString($_POST['primera_bajamar'], "text"),
					   GetSQLValueString($_POST['segunda_bajamar'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($updateSQL, $connect) or die(mysql_error());

  $updateGoTo = "mareas_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $updateGoTo));
  header("Location: mareas_lista.php");
}

$varProducto_DatosProducto = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProducto = (get_magic_quotes_gpc()) ? $_GET["recordID"] : addslashes($_GET["recordID"]);
}
mysql_select_db($database_connect, $connect);
$query_DatosProducto = sprintf("SELECT * FROM mareas WHERE mareas.id=%s", $varProducto_DatosProducto);
$DatosProducto = mysql_query($query_DatosProducto, $connect) or die(mysql_error());
$row_DatosProducto = mysql_fetch_assoc($DatosProducto);
$totalRows_DatosProducto = mysql_num_rows($DatosProducto);

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

  <div class="feature"> 
  
    <h1>Editar Mareas </h1>
   <p>&nbsp;</p>
  
   
   <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Dia:</td>
          <td><input type="text" name="dia" value="<?php echo $row_DatosProducto['dia']; ?>" size="32" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Primera pleamar:</td>
          <td><input type="text" name="primera_pleamar" value="<?php echo $row_DatosProducto['primera_pleamar']; ?>" size="32" onChange="validarNumero(this.value)" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Segunda pleamar:</td>
          <td><input type="text" name="segunda_pleamar" value="<?php echo $row_DatosProducto['segunda_pleamar']; ?>" size="32" onChange="validarNumero(this.value)" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Primera bajamar:</td>
          <td><input type="text" name="primera_bajamar" value="<?php echo $row_DatosProducto['primera_bajamar']; ?>" size="32" onChange="validarNumero(this.value)" required></td>
        </tr>
        <tr valign="baseline">
           <td nowrap align="right">Segunda bajamar:</td>
          <td><input type="text" name="segunda_bajamar" value="<?php echo $row_DatosProducto['segunda_bajamar']; ?>" size="32" onChange="validarNumero(this.value)" required></td>
        </tr>
         <tr valign="baseline">
           <td nowrap align="right">&nbsp;</td>
           <td><input type="submit" value="Update record"></td>
         </tr>
       </table>
       <input type="hidden" name="MM_update" value="form1">
       <input type="hidden" name="id" value="<?php echo $row_DatosProducto['id']; ?>">
     </form>
     <p>&nbsp;</p>
   </h2>
   <!-- InstanceEndEditable -->  </div>
</div>
<!--end content -->

</body>
<!-- InstanceEnd --></html>

