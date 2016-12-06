<?php
include("modelo.php"); //Con la ruta donde esta
session_start();

$modelo = new Modelo();
//Con el idVuelo que pasamos en la URL consultamos todos los datos
$vuelo = $modelo->selectVuelo($_GET['idVuelo']);

$idVuelo    = $vuelo['idVuelo'];
$idAvion    = $vuelo['idAvion'];
$origen     = $vuelo['origen'];
$destino    = $vuelo['destino'];
$precioV    = $vuelo['precioV'];

$nombreCli  = $_SESSION['nombreCli'];
$dni        = $_SESSION['dni'];
$tipoCli    = $_SESSION['tipoCli'];

$asiento    = $_GET['asiento']
?>        
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        
        //Comprobamos si existe la variable de sesion nombreCli
        //Que nos indica si ya se ha registrado el cliente
        if (isset($_SESSION['nombreCli'])) {
            ?>
                
                <p>Nombre Cliente: <?php echo $nombreCli?></p>
                <p>DNI: <?php echo $dni?></p>
                <p>Tipo Cliente: <?php echo $tipoCli?></p>
                <p>ID Avion: <?php echo $idAvion?></p>
                <p>ID Vuelo: <?php echo $idVuelo?></p>
                <p>Origen: <?php echo $origen?></p>
                <p>Destino: <?php echo $destino?></p>
                <p>Asiento: <?php echo $asiento?></p>
                
                <?php 
                
                    if(strcmp($tipoCli, "premium")==0){
                        ?><p>Precio especial premium: <?php echo $precioV*0.9?></p><?php
                    }else{
                        ?><p>Precio: <?php echo $precioV?></p><?php
                    }
                ?>
                
                
                <a><button  name = "boton" value="Confirmar">Confirmar</button></a>
                
                
            <?php
        }else{
                //Muestro alert
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Para hacer una reserva tiene que registrarse')
                        window.location.href='acceso.html';
                    </SCRIPT>");
        }?>

    </body>
</html>
