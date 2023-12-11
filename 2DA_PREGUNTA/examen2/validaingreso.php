<?php 
$link=mysqli_connect("localhost","u324","123456","academico2");
$usuario=$_GET["ci"];
$clave=$_GET["pass"];
session_start();
$resultado=mysqli_query($link, "select count(*) as cantidad from academico2.usuario where ci='$usuario' and pass='$clave'");
$fila=mysqli_fetch_array($resultado);
if ($fila["cantidad"]>0) 
{
	$resultado=mysqli_query($link, "select *from academico2.usuario where ci='$usuario' and pass='$clave'");
	$fila=mysqli_fetch_array($resultado);
	$_SESSION["rol"]=$fila["rol"];
	$_SESSION["ci"]=$fila["ci"];
	header("Location: bandejae.php");
	exit;
}
else 
{
 header("Location: index.php");
 exit;
}

?>