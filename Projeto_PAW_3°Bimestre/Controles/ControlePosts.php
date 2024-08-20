<?php
    session_start();
    require_once("../Classes/Usuario.php");
    $usuario = new Usuario();
    $idUsuario = $_SESSION["usuario"]; 
    

    require_once('../modelo/Upload.php');
    require_once('../modelo/ResizeImage.php');
    $pasta = "../Imagens/";
    $nomeArquivo1 = uniqid().".png";
    $nomeArquivo2 = uniqid().".png";
    $nomeArquivo3 = uniqid().".png";

    $formValidação = true;
    $validação1 = 1;
    $validação2 = 1;
    $validação3 = 1;
    $validação4 = 1;

    $vetorAutores = array();
    $vetorAutores[0] = $idUsuario;

    if (!isset($_POST["titulo"])){
        $msg = "Titulo não eviado!";
        $formValidação = false;
    }
    if (!isset($_POST["subtitulo"])){
        $msg = "Subtitulo não eviado!";
        $formValidação = false;
    }
    if (!isset($_POST["texto"])){
        $msg = "Texto não eviado!";
        $formValidação = false;
    }
    if (!isset($_POST["tipoPost"])){
        $msg = "Tipo de Post não eviado!";
        $formValidação = false;
    }
    else{
        $titulo = $_POST["titulo"];
        $titulo = strip_tags($titulo);
        $subTitulo = $_POST["subtitulo"];
        $subTitulo = strip_tags($subTitulo);
        $texto = $_POST["texto"];
        $texto = strip_tags($texto);
        $tipoPost = $_POST["tipoPost"];

        $CoAutor1 = $_POST["coAutor1"];
        $CoAutor2 = $_POST["coAutor2"];
        $CoAutor3 = $_POST["coAutor3"];
        $CoAutor4 = $_POST["coAutor4"];


        if (strlen($titulo) < 4){
            $msgTitulo = "Titulo muito curto!";
            $formValidação = false;
        }
        if (strlen($subTitulo) < 4){
            $msgSubtitulo = "Subtitulo muito curto!";
            $formValidação = false;
        }
        if (strlen($texto) < 4){
            $msgTexto = "Texto muito curto!";
            $formValidação = false;
        }
        $Usuario = new Usuario();
        $vetorUsuarios = $Usuario->ConsultarUsuarios();
        if ($CoAutor1 != ""){
            for ($i=0; $i < count($vetorUsuarios); $i++){
                if ($CoAutor1 == $vetorUsuarios[$i]->getEmail()){
                    array_push($vetorAutores, $vetorUsuarios[$i]->getIdUsuario());
                    $validação1 = 1;
                    break;
                }
                else{
                    $validação1 = 0;
                }
            }
        }
        if ($CoAutor2 != ""){
            for ($i=0; $i < count($vetorUsuarios); $i++){
                if ($CoAutor2 == $vetorUsuarios[$i]->getEmail()){
                    array_push($vetorAutores, $vetorUsuarios[$i]->getIdUsuario());
                    $validação2 = 1;
                    break;
                }
                else{
                    $validação2 = 0;
                }
            }
        }
        if ($CoAutor3 != ""){
            for ($i=0; $i < count($vetorUsuarios); $i++){
                if ($CoAutor3 == $vetorUsuarios[$i]->getEmail()){
                    array_push($vetorAutores, $vetorUsuarios[$i]->getIdUsuario());
                    $validação3 = 1;
                    break;
                }
                else{
                    $validação3 = 0;
                }
            }
        }
        if ($CoAutor4 != ""){
            for ($i=0; $i < count($vetorUsuarios); $i++){
                if ($CoAutor4 == $vetorUsuarios[$i]->getEmail()){
                    array_push($vetorAutores, $vetorUsuarios[$i]->getIdUsuario());
                    $validação4 = 1;
                    break;
                }
                else{
                    $validação4 = 0;
                }
            }
        }
        if ($validação1 == 0){
            $msgCoAutor1 = "Esse usuário não existe!";
            $formValidação = false;
        }
        if ($validação2 == 0){
            $msgCoAutor2 = "Esse usuário não existe!";
            $formValidação = false;
        }
        if ($validação3 == 0){
            $msgCoAutor3 = "Esse usuário não existe!";
            $formValidação = false;
        }
        if ($validação4 == 0){
            $msgCoAutor4 = "Esse usuário não existe!";
            $formValidação = false;
        }

        if ($formValidação == true){
            if(isset($_FILES["imagem1"])){
                $Imagem1 = new Upload($_FILES["imagem1"]);
                $Imagem1->setPath($pasta);
                $messageCode = $Imagem1->upload($nomeArquivo1);
                $fotoConfimação1 = $Imagem1->getMessage($messageCode);
                $NomeImagem1 = $Imagem1->getFilename();

            }
            if (isset($_FILES["imagem2"])){
                $Imagem2 = new Upload($_FILES["imagem2"]);
                $Imagem2->setPath($pasta);
                $messageCode = $Imagem2->upload($nomeArquivo2);
                $fotoConfimação2 = $Imagem2->getMessage($messageCode);
                $NomeImagem2 = $Imagem2->getFilename();
            }
            if (isset($_FILES["imagem3"])){
                $Imagem3 = new Upload($_FILES["imagem3"]);
                $Imagem3->setPath($pasta);
                $messageCode = $Imagem3->upload($nomeArquivo3);
                $fotoConfimação3 = $Imagem3->getMessage($messageCode);
                $NomeImagem3 = $Imagem3->getFilename();
            }
        }
    }
    if ($formValidação == false){
        
        $urlRetorno = "../Posts.php?msg=$msg&msgTitulo=$msgTitulo&msgSubtitulo=$msgSubtitulo&msgTexto=$msgTexto&titulo=$titulo&subtitulo=$subTitulo&msgCoAutor1=$msgCoAutor1&msgCoAutor2=$msgCoAutor2&msgCoAutor3=$msgCoAutor3&msgCoAutor4=$msgCoAutor4&msgFoto1=$msgFoto1&msgFoto2=$msgFoto2&msgFoto3=$msgFoto3&CoAutor1=$CoAutor1&CoAutor2=$CoAutor2&CoAutor3=$CoAutor3&CoAutor4=$CoAutor4";
        unset($_SESSION["texto"]);
        $_SESSION["texto"] = $texto;
        
        header("Location: $urlRetorno");
    }
    else{
        $texto = str_replace(PHP_EOL, "<br>", $texto, $i);
        include "../Classes/Post.php";
        include "../Classes/PostFotos.php";
        $Post = new Post();
        date_default_timezone_set('America/Sao_Paulo');
        $momento = date("Y-m-d H:i:s");
        $post = "$texto";
        $Post->setIdPost(rand(0, 999999999));
        $Post->setMometo($momento);
        $Post->setPost($post);
        $Post->setTitulo($titulo);
        $Post->setSubtitulo($subTitulo);
        $Post->setTipoPost_idTipoPost($tipoPost);
        $Post->CadastrarPost();
        $PostFoto = new PostFotos();

        if ($fotoConfimação1 == "Arquivo enviado com sucesso."){
            $PostFoto->setPost_idPost($Post->getIdPost());
            $PostFoto->setFoto($nomeArquivo1);
            $PostFoto->CadastrarPostFotos();
        }
        if ($fotoConfimação2 == "Arquivo enviado com sucesso."){
            $PostFoto->setPost_idPost($Post->getIdPost());
            $PostFoto->setFoto($nomeArquivo2);
            $PostFoto->CadastrarPostFotos();
            echo $nomeArquivo2;
        }
        if ($fotoConfimação3 == "Arquivo enviado com sucesso."){
            $PostFoto->setPost_idPost($Post->getIdPost());
            $PostFoto->setFoto($nomeArquivo3);
            $PostFoto->CadastrarPostFotos();
        }

        include "../Classes/AutoresPost.php";
        $Autores = new AutoresPost();
        for ($i=0; $i < count($vetorAutores); $i++){
            $Autores->setPost_idPost($Post->getIdPost());
            $Autores->setUsuario_idUsuario($vetorAutores[$i]);
            $Autores->CadastrarAutoresPost();
        }


        $urlRetorno = "../Destinos/PostsDestino.php";
        header("Location: $urlRetorno");

    }
?>