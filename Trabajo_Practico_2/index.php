<?php
use \Firebase\JWT\JWT;

require_once __DIR__.'/vendor/autoload.php';
require_once './Clases/Users.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$pathInfo = $_SERVER['PATH_INFO'];

switch($requestMethod)
{
    case 'POST':
            switch($pathInfo)
            {
                case '/singin': 
                    if(isset($_POST['email']) && isset($_POST['password']) && isset( $_POST['name'])&&
                       isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['type'])){
                        
                        if(Users::SigIn($_POST['email'],$_POST['password'], $_POST['name'],
                        $_POST['lastname'],$_POST['phone'],$_POST['type'])){
                            echo "Usuario Creado Correctamente";
                        }else{
                            echo "Error en los campos";
                        }
                    }
                break;

                case '/login':                     
                    $message = "Usted ha ingresado correctamente";
                    if(isset($_POST['email']) && isset($_POST['password'])){
                        $_SESSION['Usuario'] =  Users::Login($_POST['email'],$_POST['password']);
                        var_dump($_SESSION['Usuario']);
                        if(!$_SESSION['Usuario']){
                            $message =  "Combinacion Mail/Contraseña Incorrectos";
                        }                        
                    }else{
                        $message = "Debe cargar Mail y Password para ingresar";
                    }
                    echo $message;
                break;
            
            }   
    break;

    case 'GET': 
    switch ($pathInfo) {
        case '/detalle':
            if(isset($_GET['token'])){
                $detail = Users::MostrarUser($_GET['token']);
                if($detail){
                    echo($detail);
                }else{
                    echo "Error en el token";
                }
            }else{
                echo "Debe pasar un token";
            }
        break;
        case '/lista': 
            if(isset($_GET['token'])){
                $usuario = Users::MostrarUsuarios($_GET['token']);
                if($usuario != ""){
                    print_r($usuario);
                }else{
                    echo "Usuario no encontrado";
                }
                
            }
        break;
        default:
            # code...
            break;
    }       

    break;

}