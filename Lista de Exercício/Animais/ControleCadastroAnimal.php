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

    if (!isset($_GET['nomeAnimal'])){
        $msg = "Nome não enviado";
        $formValidação = false;
    }
    elseif(!isset($_GET['chipID'])){
        $msg = "Chip não enviado";
        $formValidação = false;
    }
    elseif(!isset($_GET['nascimento'])){
        $msg = "Nascimento não enviado";
        $formValidação = false;
    }
    elseif(!isset($_GET['sexo'])){
        $msg = "sexo não enviado";
        $formValidação = false;
    }
    elseif(!isset($_GET['RacaAnimal'])){
        $msg = "Raça não enviado";
        $formValidação = false;
    }
    elseif(!isset($_GET['cpf'])){
        $msg = "CPF não enviado";
        $formValidação = false;
    }
    else{
        $nome = $_GET['nomeAnimal'];
        $chip = $_GET['chipID'];
        $nasci = $_GET['nascimento'];
        $sexo = $_GET['sexo'];
        $IdRaça = $_GET['RacaAnimal'];
        $cpf = $_GET['cpf'];

        $nome = strip_tags($nome);
        $chip = strip_tags($chip);
        $nasci = strip_tags($nasci);
        $sexo = strip_tags($sexo);
        $IdRaça = strip_tags($IdRaça);
        $cpf = strip_tags($cpf);

        if (strlen($nome) < 3){
            $msg = "Nome inválido";
            $formValidação = false;
        }
        elseif (is_numeric($chip) == false){
            $msg = "Chip inválido";
            $formValidação = false;
        }
        elseif (strlen($nasci) < 3){
            $msg = "Nascimento inválido";
            $formValidação = false;
        }
        elseif (strlen($sexo) != 1 || $sexo != "M" && $sexo != "F"){
            $msg = "sexo inválido";
            $formValidação = false;
        }
        elseif(is_numeric($IdRaça) == false){
            $msg = "Raça inválida";
            $formValidação = false;
        }
        elseif (ValidaCPF($cpf) == false){
            $msg = "cpf inválido";
            $formValidação = false;
        }
    }
    if ($formValidação == false){
        $urlRetorno = "CadastroAnimais.php?nomeAnimal=$nome&chipID=$chip&nascimento=$nasci&sexo=$sexo&cpf=$cpf&msg=$msg";
        header("location: $urlRetorno");
    }
    else{
        $urlRetorno = "CadastroAnimaisDestino.php?nomeAnimal=$nome&chipID=$chip&nascimento=$nasci&sexo=$sexo&RacaAnimal=$IdRaça&cpf=$cpf";
        header("location: $urlRetorno");
    }

?>