<?php
$servername="localhost";
$db_user="root";
$db_password="";
$db_name="suscribir";
$db_table_name="usuarios";
   $db_connection = mysqli_connect($servername, $db_user, $db_password, $db_name);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}
$subs_name = utf8_decode($_POST['nombre']);
$subs_last = utf8_decode($_POST['apellido']);
$subs_email = utf8_decode($_POST['email']);
$subs_phone =utf8_decode($_POST['telefono']);
$subs_edad =utf8_decode($_POST['edad']);
$subs_agree =utf8_decode($_POST['accede']);

$resultado=mysqli_query($db_connection,"SELECT * FROM ".$db_table_name." WHERE Email = '".$subs_email."'");

if (mysqli_num_rows($resultado)>0)
{

   mysqli_free_result($resultado);
   header('Location: Fail.html');

} else {
	
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`Nombre` , `Apellido` , `Email`,`Telefono`,`Edad`,`Accede`) VALUES ("' . $subs_name . '", "' . $subs_last . '", "' . $subs_email . '", "' . $subs_phone . '", "' . $subs_edad . '","' . $subs_agree . '")';

   mysqli_select_db($db_connection, $db_name);
   $retry_value = mysqli_query($db_connection, $insert_value);

   if (!$retry_value) {
      die('Error: ' . mysqli_error($db_connection));
   }
	
   mysqli_free_result($resultado);

   header('Location: Success.html');

}

mysqli_close($db_connection);

		
?>