<?php
include("modelo.php");

$modelo = new Modelo();
//Con el idVuelo que pasamos en la URL consultamos todos los datos
$vuelo = $modelo->selectVuelo($_GET['idVuelo']);

$idVuelo = $vuelo['idVuelo'];
$idAvion= $vuelo['idAvion'];
$origen = $vuelo['origen'];
$destino = $vuelo['destino'];
$precioV = $vuelo['precioV'];

//Una vez que tenemos el idAvion podemos saber sus asientos
$avion = $modelo->selectAsientosAvion($idAvion);

$modeloAvion = $avion['modelo'];
$numAsientosTotalesAvion = $avion['numAsientos'];


//Comprobamos las reservas que hay para un el idVuelo
$asientosReservados = $modelo ->selectNumerosAsientosVuelo($idVuelo);
$nAsientosReservados = count($asientosReservados);


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <h4>Origen: <?php echo $origen?></h4>
        <h4>Destino: <?php echo $destino?></h4>
        <h4>Precio: <?php echo $precioV?></h4>
        <h4>Avión: <?php echo $idAvion?></h4>
        <h4>Modelo: <?php echo $modeloAvion?></h4>
        <h4>Asientos totales: <?php echo $numAsientosTotalesAvion?></h4>
        
        
        <h4>Numero total de asientos reservados: <?php echo $nAsientosReservados?></h4>
        
       
        <table>
            <tr>
            <?php 
            
            for(    $i=1;   $i<=$numAsientosTotalesAvion;   $i++) {
                foreach ($asientosReservados as $ar) {
                    if($i == $ar['asiento'])//Ocupado
                    {
                        ?><td><img src="css/images/butacaRoja.png"/></td><?php
                        if($i % 3 == 0){
                            ?><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php
                         } 
                        if($i % 6 == 0){
                            ?></tr><?php
                         }
                         $i++;
                    }
                }
                ?><td><a href=confirmarReserva.php?idVuelo=<?php echo $idVuelo?>&asiento=<?php echo $i?>><img src="css/images/butacaVerde.png"/></a></td><?php
                if($i % 3 == 0){
                    ?><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php
                         }
                if($i % 6 == 0){
                    ?></tr><?php
                }
            
            }?>   
            
                
        </table>        
        
        
        
        
    </body>
</html>