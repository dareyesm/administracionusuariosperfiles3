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

$idUser = $_GET['idUser'];

//Obtenemos el usuario a modificar
$single_user = $objUse->single_user($idUser);

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles();

//buscar perfiles asignados
$objDb = new Database();

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
        
        <form name="modUser" action="modify_user_exe.php" method="post">
        <input type="hidden" name="idUsers" value="<?php echo $idUser;?>" />
        <table align="center" border="1">
        
        
        	<tbody>
            	
                <?php
                
				$num_rows = mysql_num_rows($single_user);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_user)){ ?>
						
						<tr>
                        	<td><input type="text" name="login" value="<?php echo $row["loginUsers"];?>" maxlength="15" /></td>
                            <td><input type="password" name="pass" value="<?php echo $row["passUsers"];?>" maxlength="10" /></td>
                            <td><input type="text" name="email" value="<?php echo $row["emailUser"];?>" /></td>
                            
                            <td><table><?php 
							while($rowpr=mysql_fetch_array($profiles)){ ?>
                    	
                        <tr><td><?php echo $rowpr["nameProfi"];?></td>
                        <td><?php 
							
							$query = "SELECT * FROM user_pro WHERE idUsers = '".$idUser."' 
								AND idProfile = '".$rowpr["idProfile"]."' ";
							$result = $objDb->select($query);
							if($rowpr1=mysql_fetch_array($result)){?>
								<input type="checkbox" name="pro<?php echo $rowpr["idProfile"];?>" checked />
							<?php	
							}else{?>
								<input type="checkbox" name="pro<?php echo $rowpr["idProfile"];?>" />
							<?php
							}
						
						?></td>
						<td><?php
                        	if($rowpr1["default"] == '1'){?>
								<input type="radio" name="profile" value="<?php echo $rowpr["idProfile"];?>" checked />
							<?php
							}else{?>
								<input type="radio" name="profile" value="<?php echo $rowpr["idProfile"];?>" />
							<?php
							}                            
                        }?>
                        </tr>
                    </table>
                    </td>
                            <td><select name="status">
                            
                            		<option value="<?php echo $row["statusUsers"];?>"><?php echo $row["statusUsers"];?></option>
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