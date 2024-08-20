<?php
    include "./Classes/Seguidor.php";

    session_start();
    
    $seguindo = "";
    $deseguindo = "";
    
    $idUsuario = $_SESSION["usuario"];
    if (isset($_POST["seguir"])){
        $seguindo = $_POST["seguir"];
    }
    if (isset($_POST["deseguir"])){
        $deseguindo = $_POST["deseguir"];
    }

    $Seguidor = new Seguidor();

    if ($seguindo != ""){
        $Seguidor->setUsuario_idusuario_Seguido($seguindo);
        $Seguidor->setUsuario_idusuario_Seguidor($idUsuario);
        $Seguidor->CadastrarSeguidor();
    }
    else{
        $Seguidor->setUsuario_idusuario_Seguido($deseguindo);
        $Seguidor->setUsuario_idusuario_Seguidor($idUsuario);
        $Seguidor->ExcluirSeguidor();
    }

    if (isset($_POST["PaginaDestino"])){
        header("Location: ./UsuariosSeguidos.php");
    }
    else{
        header("Location: ./ProcurarUsuarios.php");
        
    }
    
    





?>