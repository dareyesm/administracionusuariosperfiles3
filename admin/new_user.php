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
require'../class/profiles.php';
require'../class/Pmenu.php';
require'../global/constants.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objUse = new Users();
$objPro = new Profiles();

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles();

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
        
        <form name="newUser" action="new_user_exe.php" method="post">
        <table align="center" border="1">
        
        
        	<tbody>
            	
                <tr>
                    <td><input type="text" name="login"  maxlength="15" /></td>
                    <td><input type="password" name="pass" maxlength="10" /></td>
                    <td><input type="text" name="email" /></td>
                    <td><table><?php 
							while($rowpr=mysql_fetch_array($profiles)){ ?>
                    	
                        <tr><td><?php echo $rowpr["nameProfi"];?></td>
                        <td><input type="checkbox" name="pro<?php echo $rowpr["idProfile"];?>" /></td>
						<td><input type="radio" name="profile" value="<?php echo $rowpr["idProfile"];?>" /><?php
                                
                        }?>
                        </tr>
                    </table>
                    </td>
                    <td><select name="status">
                    
                            <option value=""></option>
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        
                        </select>
                    </td>
                    <tr><td colspan="5" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
                </tr>
            	
            </tbody>
        
        </table>
        </form>
    
    </body>
</html>