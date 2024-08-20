<?php

    include "../Classes/Comentario.php";
    $Comentario = new Comentario();
    $formValidação = true;
    $idPost = $_POST["idPost"];
    $idUsuario = $_POST["idUsuario"];

    if (!isset($_POST["comentario"])){
        $msg = "Comentario não enviado!";
        $formValidação = false;
    }
    else if(!isset($_POST["nota"])){
        $msg = "Nota não enviada!";
        $formValidação = false;
    }
    else{

        $comentario = $_POST["comentario"];
        $comentario = strip_tags($comentario);
        $nota = $_POST["nota"];


        if(strlen($comentario) < 3){
            $msgComentario = "Comentario muito curto!";
            $formValidação = false;
        }
        if ($nota == 0){
            $msgNota = "Selecione uma nota!";
            $formValidação = false;
        }

    }

    if ($formValidação == false){
        $urlRetorno = "../PostUsuario.php?idpost=$idPost&msg=$msg&msgComentario=$msgComentario&msgNota=$msgNota&comentario=$comentario";
        header("Location: $urlRetorno");
    }
    else{
        $Comentario->setComentario($comentario);
        $Comentario->setNota($nota);
        $Comentario->setPost_idPost($idPost);
        $Comentario->setUsuario_idUsuario($idUsuario);
        $Comentario->CadastrarComentario();

        $urlRetorno = "../PostUsuario.php?idpost=$idPost";
        header("Location: $urlRetorno");
    }



?>