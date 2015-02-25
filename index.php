<?php include('Connections/connect.php'); 

?>
<?php

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 liansitional//EN" "http://www.w3.org/li/xhtml1/DTD/xhtml1-liansitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Adminisliacion Principal</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="stylesheet" href="style/adminlogin.css" type="text/css" /> 

</head>

<body>

   
   <script type="text/javascript">


function showlogin()
{
  document.getElementById('adminlogin').style.display='block';
  
};

   </script>
   
   

   
   <p>&nbsp;</p>
   
   <!----------------------------LOGIN START-------------------------------->
   <span href="#" class="button" id="toggle-login" onclick=showlogin()>Log in</span>

<div id="login" >
  <div id="triangle"></div>
  <h1>Log in</h1>
  <form id="adminlogin" action="adminlogin.php" style='display:none;'>
    <input type="Email" name="name" placeholder="Name@name.name" />
    <input type="password" name="password" placeholder="Password" />
    <input type="submit" value="Log in" />
  </form>
</div>
 <?php if (isset($_COOKIE['error'])) echo " $_COOKIE[error]" 
?>  
    <p>&nbsp;</p>
  <!-- InstanceEndEditable -->  
</div>
<!--end content -->
  
  
  

</div>


</body>
<!-- InstanceEnd --></html>