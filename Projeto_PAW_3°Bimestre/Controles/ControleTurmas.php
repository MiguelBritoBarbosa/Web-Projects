<?php
    include "../Classes/Turmas.php";
    $turmaObj = new Turma();
    $Turmas = $turmaObj->ConsultarTurmas();

    $formValidação = true;


    if (!isset($_POST["turma"])){
        $msg = "Turma não enviada";
        $formValidação = false;
    }
    else if(!isset($_POST["ano"])){
        $msg = "Ano não enviado";
        $formValidação = false;
    }
    else{
        $turma = $_POST["turma"];
        $turma = strip_tags($turma);
        $ano = $_POST["ano"];
        $ano = strip_tags($ano);

        if (strlen($turma) != 4 || is_numeric(substr($turma, 0 ,1)) == false || is_string(substr($turma, 1, 2)) != "°" || ctype_alpha(substr($turma, 3, 1)) == false){
            $msgTurma = "Digite a turma corretamente!";
            $formValidação = false;
        }
        else{
            for ($i = 0; $i < count($Turmas); $i++){
                if ($turma == $Turmas[$i]->getNomeTurma()){
                    $msgTurma = "Turma já cadastrada!";
                    $formValidação = false;
                    break;
                }
            }
        }
        if(is_numeric($ano) == false || (int)$ano <= 0 || (int)$ano > 3 ){
            $msgAno = "Digite um ano válido (1..3)";
            $formValidação = false;
        }

        if (substr($turma, 0, 1) != $ano){
            $msg = "A turma deve ser equivalente ao ano!";
            $formValidação = false;
        }


    }

    if ($formValidação == false){
        $urlRetorno = "../CadastrarTurma.php?msg=$msg&msgTurma=$msgTurma&msgAno=$msgAno&turma=$turma&ano=$ano";
        header("location: $urlRetorno");
    }
    else{
        $turmaObj->setNomeTurma($turma);
        $turmaObj->setAno($ano);
        $turmaObj->CadastrarTurma();
        $urlRetorno = "../Destinos/TurmasDestino.php?turma=$turma&ano=$ano";
        header("location: $urlRetorno");
    }
?>