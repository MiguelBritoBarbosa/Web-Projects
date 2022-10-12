<?php
    function validaCPF($cpf)
    {
    
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
    
    $formValidação = true;
    
    
    if (!isset($_POST["nome"])) {
        $msg = "Nome não enviado";
        $formValidação = false;
    } else if(!isset($_POST["idade"])){
        $msg = "Idade não enviada";
        $formValidação = false;
    } else if (!isset($_POST["celular"])) {
        $msg = "Número de celular não enviado";
        $formValidação = false;
    } else if (!isset($_POST["email"])) {
        $msg = "Email não enviado";
        $formValidação = false;
    } else if (!isset($_POST["cpf"])) {
        $msg = "CPF não enviado";
        $formValidação = false;
    } else if (!isset($_POST["Sscore"])) {
        $msg = "Serasa Score não enviado";
        $formValidação = false;
    } else if (!isset($_POST["salario"])) {
        $msg = "Salário não enviado";
        $formValidação = false;
    } else {
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];
        $celular = $_POST["celular"];
        $email = $_POST["email"];
        $cpf = $_POST["cpf"];
        $SerasaScore = $_POST["Sscore"];
        $salario = $_POST["salario"];
    
        $nome = strip_tags($nome);
        $idade = strip_tags($idade);
        $celular = strip_tags($celular);
        $email = strip_tags($email);
        $cpf = strip_tags($cpf);
        $SerasaScore = strip_tags($SerasaScore);
        $salario = strip_tags($salario);
        $salario = str_replace("R$ ", "", $salario);
        $salario = str_replace(".", "", $salario);
        $salario = str_replace(",", ".", $salario);
        
        

        if (strlen($nome) < 3) {
            $msg = "Digite um nome válido";
            $formValidação = false;
        } else if(is_numeric($idade) == false || $idade < 16 || $idade > 100){
            $msg = "Digite uma idade válida";
            $formValidação = false;
        } else if (strlen($celular) < 11 || strlen($celular) > 15) {
            $msg = "Digite um número de celular válido";
            $formValidação = false;
        } else if (strlen($email) < 10 || strpos($email, "@") == false) {
            $msg = "Digite um email válido";
            $formValidação = false;
        } else if (validaCPF($cpf) == false) {
            $msg = "Digite um cpf válido";
            $formValidação = false;
        } else if ($SerasaScore < 500 || $SerasaScore > 1000 || is_numeric($SerasaScore) == false) {
            $msg = "Digita um Serasa Score válido";
            $formValidação = false;
        } else if (is_numeric($salario) == false || (float) $salario <= 100) {
            $msg = "Digite um salário válido";
            $formValidação = false;
        }
       

        if ($formValidação == true) {
            $urlRetorno = "./Cadastrar.php?nome=$nome&idade=$idade&celular=$celular&email=$email&cpf=$cpf&Sscore=$SerasaScore&salario=$salario";
            header("location: $urlRetorno");
        } else {
            $urlRetorno = "./index.php?nome=$nome&idade=$idade&celular=$celular&email=$email&cpf=$cpf&Sscore=$SerasaScore&salario=$salario&msg=$msg";
            header("location: $urlRetorno");
        }
    }
?>