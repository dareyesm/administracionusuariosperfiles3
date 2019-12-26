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
$objMod = new Modules();
$list_modules = $objMod->show_modules();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administrar Modulos!!</title>
    </head>
    
    <body>
    	
        <?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        
        <table align="center" border="1">
        	
            <thead>
            	<tr><td colspan="7" align="center"><a href="new_module.php">Nuevo Módulo</a></td></tr>
                <tr><th colspan="7" align="center">Listado de Modulos!!!</th></tr>
                <tr>
                	<td>Código</td>
                    <td>Nombre del Modulo</td>
                    <td>Descripción</td>
                    <td>Creado el</td>
                    <td>Estado</td>
                    <td colspan="2" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_modules);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_modules)){?>
                    
                    	<tr>
                        	<td><?php echo $row["codeModule"];?></td>
                            <td><?php echo $row["nameModule"]; ?></td>
                            <td><?php echo $row["descModule"]; ?></td>
                            <td><?php echo $row["dateModule"]; ?></td>
                            <td><?php echo $row["statusModu"]; ?></td>
                            <td><a href="modify_module.php?idmodule=<?php echo $row["idmodule"];?>">Modificar</a></td>
							<td><a href="delete_module.php?idmodule=<?php echo $row["idmodule"];?>">Eliminar</a></td>
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        
    </body>
</html>