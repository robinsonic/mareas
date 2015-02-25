<?php include('Connections/connect.php'); ?>
<?php
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connect, $connect);
if (isset($_POST["buscar"])) {
$buscar=$_POST["buscar"];
$query_Recordset1 = "SELECT * FROM mareas where mareas.dia= '$buscar' ";
}else{  
   $query_Recordset1 = "SELECT * FROM mareas ORDER BY mareas.dia ASC";
}
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


<html>
<head><title></title></head>
<body>
<h1>Lista de Mareas</h1>
 <form method="post" name="form1" action="mareas_lista.php">
 <input type="text" name="buscar" value="" size="32" placeholder="dd mes" required>
 <input type="submit" value="Buscar record">
 </form>
   <p><a href="mareas_add.php">A&ntilde;adir</a></p>
   <table width="741" height="76" <!--border="1"-->
     <tr class="tablaprincipal" bgcolor="#66CCCC">
       <td width="105">Dia </td>
       <td width="165">primera pleamar</td>
	   <td width="165">segunda pleamar</td>
	   <td width="165">primera bajamar</td>
	   <td width="165">segunda bajamar</td>
       <td width="188">Acciones</td>
     </tr>
     
       <?php do { ?>
	   <tr class="brillo">
         <td><?php echo $row_Recordset1['dia']; ?></td>
         <td><?php echo $row_Recordset1['primera_pleamar']."h"; ?></td>
		 <td><?php echo $row_Recordset1['segunda_pleamar']."h"; ?></td>
		 <td><?php echo $row_Recordset1['primera_bajamar']."h"; ?></td>
		 <td><?php echo $row_Recordset1['segunda_bajamar']."h"; ?></td>
         <td><a href="mareas_edit.php?recordID=<?php echo $row_Recordset1['id']; ?>">Editar</a> - <a href="mareas_delete.php?rec=<?php echo $row_Recordset1['id']; ?>">Eliminar</a> </td>
		 </tr>
         <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
   </table>
</body>
</html>