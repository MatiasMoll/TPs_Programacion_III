<?php

use \Firebase\JWT\JWT;
    
require_once './vendor/autoload.php';
require_once __DIR__.'/Datos.php';


class Users{ 

    public $email;
    public $password;
    public $name;
    public $lastname;
    public $phone;
    public $isUser; //If is true, the type is User, otherwise is Admin

    public function __construct($email,$password,$name,$lastName,$phone,$isUser) //Uses in SignIn
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->lastname = $lastName;
        $this->phone = $phone;
        $this->isUser = $isUser;
    }
    public static function SigIn($email, $clave, $nombre, $apellido, $telefono, $BooleanoUser){
        $response = false;
        $newUser = new Users($email,$clave,$nombre,$apellido,$telefono,$BooleanoUser);
        if(Data::Save('usuarios.txt',$newUser)){
            $response = true;
        }
        return $response;
    }
    private static function ValidateExistingUser($emailRegistrado,$passRegistrada,$emailEntrante,$passEntrante){
        $response = false;
        if($emailRegistrado == $emailEntrante && $passRegistrada == $passEntrante){
            $response = true;
        }
        return $response;
    }
    public static function Login($email,$clave){
        $response = Data::Load('usuarios.txt');
        $flag = false;
        if($response){
            $key = "Usuario Registrado";
            foreach ($response as $usuario) {
               if($usuario != "" && $usuario->email == $email && $usuario->password == $clave){
                $payload = array(
                    "email" => $email,
                    "clave" => $clave,
                    "nombre" => $usuario->name,
                    "apellido"=>$usuario->lastname,
                    "telefono"=>$usuario->phone,
                    "tipo"  => $usuario->isUser
                 );
                 $flag=true;
                break;
                }                
            }
            if($flag){
                $flag= JWT::encode($payload,$key);
            }
        }
        return $flag; 
    }
    public static function MostrarUser($token){
        $response = false;
        try{
            $decoded = JWT::decode($token,"Usuario Registrado", array("HS256"));
            $response = "Nombre: ".$decoded->nombre .PHP_EOL
                        ."Apellido: ".$decoded->apellido .PHP_EOL
                        ."Usuario: ".$decoded->email .PHP_EOL
                        ."Password: ".$decoded->clave .PHP_EOL
                        ."Telefono: ".$decoded->telefono .PHP_EOL
                        ."Privilegios: ";
            if($decoded->tipo == "true"){
                $response = $response."Usuario";
            }else{
                $response = $response."Administrador";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $response;
    }

    public static function MostrarUsuarios($token){
        $users = JWT::decode($token,"Usuario Registrado", array("HS256"));
        $response = "";
        $lista = Data::Load('usuarios.txt');
        
        if($users){
            if($users->tipo == "true"){
                foreach($lista as $user){
                    if($user->isUser == "true"){
                        $response = $response.$user->name.PHP_EOL;
                    }
                }
            }else{
                foreach($lista as $admin){
                    $response = $response.$admin->name.PHP_EOL;
                }
            }

        }
        return $response;      

    }

}