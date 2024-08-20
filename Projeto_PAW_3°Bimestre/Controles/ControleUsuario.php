<?php

    require_once('../modelo/Upload.php');
    require_once('../modelo/ResizeImage.php');
    $pasta = "../Imagens/";
    $nomeArquivo = uniqid().".png";
    $formValidação = true;

    include "../Classes/Usuario.php";
    $Usuarios = new Usuario();
    $vetorUsuarios = $Usuarios->ConsultarUsuarios();


    if (!isset($_POST["nome"])){
        $msg = "Nome não enviado!";
        $formValidação = false;
    }
    else if (!isset($_POST["email"])){
        $msg = "Email não enviado!";
        $formValidação = false;
    }
    else if(!isset($_POST["senha"])){
        $msg = "senha não enviada!";
        $formValidação = false;
    }
    else if (!isset($_POST["dataNasci"])){
        $msg = "Data de nascimento não enviada!";
        $formValidação = false;
    }
    else if (!isset($_POST["turma"])){
        $msg = "Turma não enviada!";
        $formValidação = false;
    }
    else{
        $nome = $_POST["nome"];
        $nome = strip_tags($nome);
        $email = $_POST["email"];
        $email = strip_tags($email);
        $senha = $_POST["senha"];
        $senha = strip_tags($senha);
        $dataNasci = $_POST["dataNasci"];
        $turma = $_POST["turma"];


        if (strlen($nome) < 3){
            $msgNome = "Digite um nome válido!";
            $formValidação = false;
        }
        if(strlen($email) < 10 || strpos($email, "@") == false){
            $msgEmail = "Digite um email válido!";
            $formValidação = false;
        }
        else{
            for ($i = 0; $i < count($vetorUsuarios); $i++){
                if ($email == $vetorUsuarios[$i]->getEmail()){
                    $msgEmail = "Email já cadastrado!";
                    $formValidação = false;
                    break;
                }
            }
        }
        if(strlen($senha) < 6){
            $msgSenha = "Digite uma senha com 6 caracteres ou mais!";
            $formValidação = false;
        }
        if (strtotime($dataNasci) < strtotime("1920-01-01") || strtotime($dataNasci) >= strtotime(date("Y-m-d"))){
            $msgDataNasci = "Data de nascimento inválida!";
            $formValidação = false;
        }
        if ($formValidação == true){
            //foto ->
            if (isset($_FILES["foto"])){
                $foto = new Upload($_FILES["foto"]);
                $foto->setPath($pasta);
                $messageCode = $foto->upload($nomeArquivo);
                $fotoConfimação = $foto->getMessage($messageCode);
                $NomeFoto = $foto->getFilename();
                // fim foto ->
                if ($fotoConfimação != "Arquivo enviado com sucesso."){
                    $msgFoto = "Erro ao enviar a foto";
                    $formValidação = false;
                }
            }
        }
    }

    if ($formValidação == false){
        $urlRetorno = "../CadastrarUsuario.php?msg=$msg&msgNome=$msgNome&msgEmail=$msgEmail&msgSenha=$msgSenha&msgFoto=$msgFoto&msgDataNasci=$msgDataNasci&nome=$nome&email=$email";
        header("location: $urlRetorno");
    }
    else{
        
        $Usuarios->setNome($nome);
        $Usuarios->setEmail($email);
        $Usuarios->setSenha($senha);
        $Usuarios->setDataNascimento($dataNasci);
        $Usuarios->setFoto($NomeFoto);
        $Usuarios->setTurma_id($turma);
        $Usuarios->CadastrarUsario();
        $vetor = $Usuarios->ConsultarUsuarios();
        for ($i=0; $i < count($vetor); $i++){
            if ($email == $vetor[$i]->getEmail()){
                $idUsuario = $vetor[$i]->getIdUsuario();
            }
        }

        $urlRetorno = "../Destinos/UsuariosDestino.php?nome=$nome&idUsuario=$idUsuario";
        header("location: $urlRetorno");

    }

    





?>