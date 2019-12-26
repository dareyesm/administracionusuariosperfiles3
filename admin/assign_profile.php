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

$idPerfil = $_GET["idPerfil"];

//consultamos el listado de los usuarios!!
$objPer = new Profiles();
$objMod = new Modules();

$perfil = $objPer->single_profile($idPerfil);
$module = $objMod->show_modules();
//para buscar modulos asignados al perfil seleccionado!
$objassig = new Profiles();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Asignar Modulos al Perfil Seleccionado!!</title>
    </head>
    
    <body>
    
    	<?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        <form name="assigmod" action="assign_module_exe.php" method="post">
        <table align="center" border="1">
        	<tbody>
				<?php $num_rowsP = mysql_num_rows($perfil);
				$num_rowsM = mysql_num_rows($module);
                
                if($num_rowsP > 0){
                	if($row=mysql_fetch_array($perfil)){?>
						<tr><td colspan="2">Asignación de Modulos al Perfil: <?php echo $row["nameProfi"];?></td></tr>
					<?php
						if($num_rowsM > 0){
							
							while($rowM=mysql_fetch_array($module)){
								$assign_mod = $objassig->look_assign($rowM["idmodule"], $idPerfil);
								$num_assign = mysql_num_rows($assign_mod);?>
								
                                <tr>
                                	<td><?php echo $rowM["nameModule"];?></td>
                                	<td><?php if($num_assign > 0){?>
										<input type="checkbox" name="<?php echo $rowM["nameModule"];?>" checked />
									<?php
									}else{?>
										<input type="checkbox" name="<?php echo $rowM["nameModule"];?>" />
                                    <?php }?>
									</td>
                                </tr>
							<?php
								
							}
							?><input type="hidden" name="idPerfil" value="<?php echo $idPerfil;?>" />
							<?php
							
						}
					
					
					}
                }
                
                ?>
                <tr><td colspan="2" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
            </tbody>
        
        </table>
        </form>
    
    </body>
</html>