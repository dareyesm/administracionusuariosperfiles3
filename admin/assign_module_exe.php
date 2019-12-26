<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://localhost:8888/designprojects/users/index.php?error=2');
}

?>
<?php
//Llamado de los archivos clase
require'../class/config.php';
require'../class/profiles.php';
require'../class/modules.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objPer = new Profiles();
$objPer->assign_module();

header('Location: profile_list.php');


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Asignar Modulos</title>
        <meta charset="utf-8">
    </head>
    <body>
    	
    </body>
</html>