<?php

session_start();
include("modelo.php");


$dni = $_POST['dni'];
$nombreCli = $_POST['nombreCli'];
$fechaNacCli = $_POST['fechaNacCli'];
$emailCli = $_POST['emailCli'];
$tipoCli = $_POST['tipoCli'];
$password = $_POST['password'];



function validateForm($dni,$nombreCli,$fechaNacCli,$emailCli,$tipoCli,$password){
        
        $errores = array();
        $paternName = "/^[a-zA-Z]+$/";
        $paternDni = "/^[0-9]{8}[a-zA-Z]$/";
        
        //Comprobaciones DNI
        if (!preg_match($paternDni,$dni))
        { array_push($errores,"dni");}
        //Comprobaciones NOMBRE
        if (!preg_match($paternName,$nombreCli) || (strcmp($nombreCli,"")==0))
        { array_push($errores,"nombreCli");}
        //Comprobaciones EMAIL
        if (!filter_var($emailCli,FILTER_VALIDATE_EMAIL) || (strcmp($emailCli,"")==0))
        { array_push($errores,"emailCli"); }
        
        //Comprobamos si ha habido algun error mirando si hay elementos en el array
        if(!empty($errores))
        {//Si no esta vacío
            drawForm($errores,$dni,$nombreCli,$emailCli);
        }else
        {
            $modelo = new Modelo();
            $modelo->insertCliente($dni, $nombreCli, $fechaNacCli, $emailCli, $tipoCli, $password);
            $cliente = $modelo->loginCliente($dni, $password);
            $_SESSION['dni'] = $cliente['dni'];
            $_SESSION['nombreCli'] = $cliente['nombreCli'];
            $_SESSION['fechaNacCli'] = $cliente['fechaNacCli'];
            $_SESSION['emailCli'] = $cliente['emailCli'];
            $_SESSION['tipoCli'] = $cliente['tipoCli'];
            $_SESSION['password'] = $cliente['password'];

            //echo '---->'.$_SESSION['nombreCli'];
            header("Location:index.php");
        }
    }
    
    function drawForm($errores,$dni,$nombreCli,$emailCli)
   {
    
        $errorDni=0;
        $errorNombre=0;
        $errorEmail=0;
        
        foreach($errores as $error)
        {
            if(strcmp("dni",$error)==0)  { $errorDni=1; }
            if(strcmp("nombreCli",$error)==0){ $errorNombre=1; }
            if(strcmp("emailCli",$error)==0) { $errorEmail=1; }
            
        }
        
        //a ternary operator which acts as a shortened IF/Else statement:
        echo '<form action="registro.php" method="POST">';
        
        echo 'Nombre: <input type="text" name="nombreCli" value="'.(($errorNombre==1)?"ERROR":$nombreCli).'"><br/>';
        echo 'DNI: <input type="text" name="dni" value="'.(($errorDni==1)?"ERROR":$dni).'"><br/>';
        echo 'E-mail: <input type="text" name="emailCli" value="'.(($errorEmail==1)?"ERROR":$emailCli).'"><br/>';
        echo 'Fecha nacimiento <input type="date" name="fechaNacCli"><br/>';
        echo 'Password: <input type="password" name="password"><br/>';
        echo 'Tipo de cuenta:';
        echo '<select name="tipoCli">
                <option value="premium">Premium
                <option value="standard">Standard
           </select>';
        echo '<input type="submit" value="Enviar"></form>';
}

validateForm($dni,$nombreCli,$fechaNacCli,$emailCli,$tipoCli,$password);