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
require'../class/dbactions.php';
require'../class/roles.php';
require'../class/modules.php';
require'../class/Pmenu.php';
require'../global/constants.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objRol = new Roles();
$objmod = new Modules();

$idrole = $_GET['idrole'];

//Obtenemos el usuario a modificar
$single_role = $objRol->single_role($idrole);
$list_module = $objmod->show_modules();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Roles!!</title>
    </head>
    
    <body>
    
    	<?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        
        <form name="modUser" action="modify_role_exe.php" method="post">
        <input type="hidden" name="idrole" value="<?php echo $idrole;?>" />
        <table align="center" border="1">
        
        
        	<tbody>
            	
                <?php
                
				$num_rows = mysql_num_rows($single_role);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_role)){ ?>
						
						<tr>
                        	<td><input type="text" name="code" value="<?php echo $row["codeRole"];?>" maxlength="15" /></td>
                            <td><input type="text" name="name" value="<?php echo $row["nameRole"];?>" /></td>
                            <td><textarea name="desc" cols="10" rows="10"><?php echo $row["descRole"];?></textarea></td>
                            <td>
                            	<select name="modules">
                                	<option value="<?php echo $row["idmodule"];?>"><?php echo $row["nameModule"];?></option>
                                    <option value=""></option>
                                    <?php while($rowM=mysql_fetch_array($list_module)){
										?><option value="<?php echo $rowM["idmodule"];?>">
											<?php echo $rowM["nameModule"];?>
                                          </option><?php
									}?>
                                </select>
                            </td>
                            <td><select name="status">
                            
                            		<option value="<?php echo $row["statRole"];?>"><?php echo $row["statRole"];?></option>
                                    <option value=""></option>
                                    <option value="Enabled">Enabled</option>
                                    <option value="Disabled">Disabled</option>
                                
                            	</select>
                            </td>
                            <tr><td colspan="5" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
                        </tr>
                        
						<?php
					}
					
				}
				
				?>
            	
            </tbody>
        
        </table>
        </form>
    
    </body>
</html>