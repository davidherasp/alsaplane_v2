<?php

session_start();
include("modelo.php");

$dni = $_POST['dni'];
$clave = $_POST['clave'];

$modelo = new Modelo();

$cliente = $modelo->loginCliente($dni, $clave);
if ($cliente != NULL) {
    //Creo un parametro de sesion para guardar los datos
    $_SESSION['dni'] = $cliente['dni'];
    $_SESSION['nombreCli'] = $cliente['nombreCli'];
    $_SESSION['fechaNacCli'] = $cliente['fechaNacCli'];
    $_SESSION['emailCli'] = $cliente['emailCli'];
    $_SESSION['tipoCli'] = $cliente['tipoCli'];
    $_SESSION['password'] = $cliente['password'];

    header("Location:index.php");
} else {
    //Muestro alert
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('NIF o clave incorrectos')
                    window.location.href='acceso.html';
    </SCRIPT>");
}
        
    






