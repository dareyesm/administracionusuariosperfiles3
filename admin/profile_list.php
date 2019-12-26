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
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los perfiles!!
$objPro = new Profiles();
$list_profiles = $objPro->show_profiles();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Perfiles!!</title>
    </head>
    
    <body>
    	
        <?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        
        <table align="center" border="1">
        	
            <thead>
            	<tr><td colspan="9" align="center"><a href="new_profile.php">Nuevo Perfil</a></td></tr>
                <tr><th colspan="9" align="center">Listado de Perfiles!!!</th></tr>
                <tr>
                	<td>Código</td>
                    <td>Nombre del Perfil</td>
                    <td>Descripción</td>
                    <td>Creado el</td>
                    <td>Estado</td>
                    <td colspan="4" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_profiles);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_profiles)){?>
                    
                    	<tr>
                        	<td><?php echo $row["codeProfi"];?></td>
                            <td><?php echo $row["nameProfi"]; ?></td>
                            <td><?php echo $row["descProfi"]; ?></td>
                            <td><?php echo $row["dateProfi"]; ?></td>
                            <td><?php echo $row["statusPro"]; ?></td>
                            <td><a href="assign_profile.php?idPerfil=<?php echo $row["idProfile"];?>">Asignar Modulos</a></td>
                            <td><a href="show_modules.php?idPerfil=<?php echo $row["idProfile"];?>">Ver Modulos Asignados</a></td>
                            <td><a href="modify_profile.php?idPerfil=<?php echo $row["idProfile"];?>">Modificar</a></td>
							<td><a href="delete_profile.php?idPerfil=<?php echo $row["idProfile"];?>">Eliminar</a></td>
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        
    </body>
</html>