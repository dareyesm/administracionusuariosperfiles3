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

$objPro = new Profiles();

$idProf = $_GET['idPerfil'];

//Obtenemos el usuario a modificar
$single_pro = $objPro->single_profile($idProf);

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
        
        <form name="modUser" action="modify_profile_exe.php" method="post">
        <input type="hidden" name="idProf" value="<?php echo $idProf;?>" />
        <table align="center" border="1">
        
        
        	<tbody>
            	
                <?php
                
				$num_rows = mysql_num_rows($single_pro);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_pro)){ ?>
						
						<tr>
                        	<td><input type="text" name="code" value="<?php echo $row["codeProfi"];?>" maxlength="15" /></td>
                            <td><input type="text" name="name" value="<?php echo $row["nameProfi"];?>" maxlength="10" /></td>
                            <td><textarea name="desc" cols="10" rows="10"><?php echo $row["descProfi"];?></textarea></td>
                            <td><select name="status">
                            
                            		<option value="<?php echo $row["statusPro"];?>"><?php echo $row["statusPro"];?></option>
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