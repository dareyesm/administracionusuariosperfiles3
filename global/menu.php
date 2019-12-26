<?php

//Inicio del menu!!
echo '<ul>';
//La opcion Inicio va estar presente en todos los perfiles!!!
echo '<li><a href="index.php">Inicio</a></li>';

$objmenu = new Pmenu();

$menu = $objmenu->show_menu();

while($rowMenu=mysql_fetch_array($menu)){
	if(in_array($rowMenu['idModule'],$_SESSION['modules'])){
		echo '<li><a href="'.URL.$rowMenu['linkMenu'].'">'.$rowMenu['nameMenu'].'</a></li>';
	}
}

//El logout va a estar presente en todos los perfiles!!!
echo '<li><a href="log_out.php">Salir</a></li>';
//fin del menu
echo '</ul>';

?>