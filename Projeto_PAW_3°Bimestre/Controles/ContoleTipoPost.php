<?php

    include "../Classes/TipoPost.php";
    $TiposPost = new TipoPost();
    $vetorTipoPost = $TiposPost->ConsultarTiposDePost();
    $formValidação = true;


    if (!isset($_POST["tipoPost"])){
        $msg = "Tipo de Post não enviado!";
        $formValidação = false;
    }
    else{
        $TipoPost = $_POST["tipoPost"];
        $TipoPost = strip_tags($TipoPost);

        if (strlen($TipoPost) < 4) {
            $msg = "Tipo de post inválido!";
            $formValidação = false;
        }
        else{
            for ($i = 0; $i < count($vetorTipoPost); $i++){
                if (strtolower($TipoPost) == strtolower($vetorTipoPost[$i]->getTipo()) ){
                    $msg = "Esse tipo de Post já existe!";
                    $formValidação = false;
                    break;
                }
            }
        }
    }

    if ($formValidação == false){
        $urlRetorno = "../CadastrarTipoPost.php?msg=$msg&tipoPost=$TipoPost";
        header("Location: $urlRetorno");
    }
    else{
        $TiposPost->setTipo($TipoPost);
        $TiposPost->CadastrasTipoPost();
        $urlRetorno = "../Destinos/TipoPostDestino.php?tipoPost=$TipoPost";
        header("Location: $urlRetorno");
    }


?>