<?php
include("modelo.php"); //Con la ruta donde esta
session_start();
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
                <!--Y mostramos su nombre-->
                <h3><?php echo $_SESSION['nombreCli']?></h3>
                <a href="cerrarSesion.php">Cerrar sesion</a>
            <?php
        }
        
        $modelo = new Modelo();
        $vuelos = $modelo->selectVuelos();
        if ($vuelos != NULL)
        {
            ?>
            <table>
            <tr>
                <th>Identificador</th>
                <th>Avion ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Precio</th>
            </tr>
            <?php 
            foreach ($vuelos as $vuelo) {
                
                //Creamos la url para cada vuelo
                $url = "reserva.php?idVuelo=".$vuelo['idVuelo'];
                ?><tr>
                    <td><?php echo $vuelo['idVuelo']?></td>
                    <td><?php echo $vuelo['idAvion']?></td>
                    <td><?php echo $vuelo['origen']?></td>
                    <td><?php echo $vuelo['destino']?></td>
                    <td><?php echo $vuelo['precioV']?></td>
                    <td><?php echo $vuelo['precioV']?></td>
                    <td><a href="<?php echo $url ?>"><button  name = "boton" value="Reservar">Reservar</button></a></td>
                <?php    
            }
            ?>
            </table>
            <?php 
        
            
        } 
        else
        {
            echo 'No existen vuelos en la base de datos';
        }
        
        //Si no existe la variable es que no se ha registrado
        //Por lo tanto mostramos las opciones de acceder y registrarse
        if (!isset($_SESSION['nombreCli'])) {
            ?>
                <a href="acceso.html"><button  name = "boton" value="Accede">Accede</button></a>
                <a href="registro.html"><button  name = "boton" value="Registro">Registro</button></a>
            <?php
        } 

        ?>
        
    </body>
</html>
