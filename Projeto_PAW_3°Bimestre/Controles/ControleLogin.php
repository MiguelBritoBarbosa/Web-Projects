<?php   

    include "../Classes/Usuario.php";
    $usuario = new Usuario();
    $Usuarios = $usuario->ConsultarUsuarios();


    $formValidação = true;
    $validação = 0;

    if(!isset($_POST["email"])){
        $msg = "Email não enviado!";
        $formValidação = false;
    }
    else if (!isset($_POST["senha"])){
        $msg = "Senha não enviada!";
        $formValidação = false;
    }
    else{
        $email = $_POST["email"];
        $email = strip_tags($email);
        $senha = $_POST["senha"];
        $senha = strip_tags($senha);

        if(strlen($email) < 10 || strpos($email, "@") == false){
            $msg = "Email ou Senha inválidos!";
            $formValidação = false;
        }
        
        for ($i = 0; $i < count($Usuarios); $i++){
            if ($email == $Usuarios[$i]->getEmail()){
                $idUsuario = $Usuarios[$i]->getIdUsuario();
                $validação = 1;
                break;
            }
        }
        if ($validação != 1){
            $msg = "Email ou Senha inválidos!";
            $formValidação = false;
        }
        
        $validação = 0;
        if(strlen($senha) < 6){
            $msg = "Email ou Senha inválidos!";
            $formValidação = false;
        }
        
        $usuario->ConsultarUmUsuario($idUsuario);
        if ($senha == $usuario->getSenha()){
            $validação = 1;
        }
        if ($validação != 1){
            $msg = "Email ou Senha inválidos!";
            $formValidação = false;
        }
        
    }

    if ($formValidação == false){
        $urlRetorno = "../index.php?msg=$msg&email=$email&senha=$senha";
        header("location: $urlRetorno");
    }
    else{
        for ($i=0; $i < count($Usuarios); $i++){
            if ($email == $Usuarios[$i]->getEmail()){
                $idUsuario = $Usuarios[$i]->getIdUsuario();
            }
        }
        $urlRetorno = "../Destinos/indexDestino.php?idUsuario=$idUsuario";
        
        echo $usuario->getSenha();
        header("Location: $urlRetorno");
    }


?>