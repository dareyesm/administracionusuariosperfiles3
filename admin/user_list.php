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
require'../class/users.php';
require'../class/roles.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objUse = new Users();
$list_users = $objUse->list_users();

//busca los roles de éste modulo

$objrol = new Roles();
$roles = $objrol->module_role('5');

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Usuarios!!</title>
    </head>
    
    <body>
    	
        <?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        
        <table align="center" border="1">
        	
            <thead>
            	<tr>
                	<td colspan="5" align="center">
                    	<?php 
						if(in_array('1',$_SESSION['roles'])){?>
							<a href="new_user.php">Nuevo Usuario</a>
						<?php
						}else{?>
							<a href="new_user.php" onClick="return false">Nuevo Usuario</a>
						<?php
						}
						?>
                    </td>
                </tr>
                <tr><th colspan="4" align="center">Listado de Usuarios!!!</th></tr>
                <tr><td>Nombre de Usuario</td><td colspan="3" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_users);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_users)){?>
                    
                    	<tr>
                        	<td><?php echo $row["loginUsers"];?></td>
                            <td>
                            	<?php 
								if(in_array('11',$_SESSION['roles'])){?>
									<a href="assign_role.php?idUser=<?php echo $row["idUsers"];?>">Roles</a>
								<?php
								}else{?>
									<a href="assign_role.php?idUser=<?php echo $row["idUsers"];?>" onClick="return false">Roles</a>
								<?php
								}
								?>
                            </td>
                            <td>
                            	<?php 
								if(in_array('3',$_SESSION['roles'])){?>
									<a href="modify_user.php?idUser=<?php echo $row["idUsers"];?>">Modificar</a>
								<?php
								}else{?>
									<a href="modify_user.php?idUser=<?php echo $row["idUsers"];?>" onClick="return false">
                                    	Modificar
                                    </a>
								<?php
								}
								?>
                            </td>
							<td>
                            	<?php 
								if(in_array('4',$_SESSION['roles'])){?>
									<a href="delete_user.php?idUser=<?php echo $row["idUsers"];?>">Eliminar</a>
								<?php
								}else{?>
									<a href="delete_user.php?idUser=<?php echo $row["idUsers"];?>" onClick="return false">
                                    	Eliminar
                                    </a>
								<?php
								}
								?>
                            </td>
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        
    </body>
</html>