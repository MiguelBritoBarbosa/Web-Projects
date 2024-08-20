<?php

    function validaCPF($cpf) {
        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
    
            $d = ((10 * $d) % 11) % 10;
    
            if ($cpf{$c} != $d) {
                return false;
            }
        }
    
        return true;
    }



    $formValidação = true;
    if(isset($_GET["telefone"])){
        $telefone = $_GET["telefone"];
      }
    if(isset($_GET["complemento"])){
        $complemento = $_GET["complemento"];
    }
    if(!isset($_GET["nome"])){
        $msg = "Nome não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["email"])){
        $msg = "Email não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["cpf"])){
        $msg = "CPF não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["celular"])){
        $msg = "Celular não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["logradouro"])){
        $msg = "Logradouro não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["numero"])){
        $msg = "Número não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["bairro"])){
        $msg = "bairro não enviado";
        $formValidação = false;
    }
    else if(!isset($_GET["estado"])){
        $msg = "estado não enviado";
        $formValidação = false;
    }
    else{
        $nome = $_GET["nome"];
        $email = $_GET["email"];
        $cpf = $_GET["cpf"];
        $telefone = $_GET["telefone"];
        $celular = $_GET["celular"];
        $logradouro = $_GET["logradouro"];
        $numero = $_GET["numero"];
        $bairro = $_GET["bairro"];
        $estado = $_GET["estado"];

        $nome = strip_tags($nome);
        $email = strip_tags($email);
        $cpf = strip_tags($cpf);
        $telefone = strip_tags($telefone);
        $celular = strip_tags($celular);
        $logradouro = strip_tags($logradouro);
        $numero = strip_tags($numero);
        $complemento = strip_tags($complemento);
        $bairro = strip_tags($bairro);
        $estado = strip_tags($estado);

        if(strlen($nome) < 3){
            $msg = "Nome inválido";
            $formValidação = false;
        }
        else if(strlen($email) < 3){
            $msg = "Email inválido";
            $formValidação = false;
        }
        else if(validaCPF($cpf) == false){
            $msg = "cpf inválido";
            $formValidação = false;
        }
        else if(strlen($celular) != 11){
            $msg = "celular inválido";
            $formValidação = false;
        }
        else if(strlen($logradouro) < 3){
            $msg = "logradouro inválido";
            $formValidação = false;
        }
        else if(is_numeric($numero) == false){
            $msg = "número dá casa inválido";
            $formValidação = false;
        }
        else if(strlen($bairro) < 3){
            $msg = "bairro inválido";
            $formValidação = false;
        }
        else if(strlen($estado) != 2){
            $msg = "estádo inválido";
            $formValidação = false;
        }
    }
    if($formValidação == false){
        $urlRetorno = "./CadastroDono.php?msg=$msg&nome=$nome&email=$email&cpf=$cpf&telefone=$telefone&celular=$celular&logradouro=$logradouro&numero=$numero&complemento=$complemento&bairro=$bairro&estado=$estado";
        header("location: $urlRetorno");
    }else{
        $urlRetorno = "./CadastroDonoDestino.php?msg=$msg&nome=$nome&email=$email&cpf=$cpf&telefone=$telefone&celular=$celular&logradouro=$logradouro&numero=$numero&complemento=$complemento&bairro=$bairro&estado=$estado";
        header("location: $urlRetorno");
    }
?>