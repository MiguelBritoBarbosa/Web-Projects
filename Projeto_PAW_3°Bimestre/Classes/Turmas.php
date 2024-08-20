<?php

    require_once("Banco.php");

    class Turma{
        private $idTurma;
        private $NomeTurma;
        private $Ano;
        private $banco;
        function __construct() {
            $this->banco = new Banco();
        }

    
        public function CadastrarTurma()
        {
            $stmt = $this->banco->getConexao()->prepare("Insert into turma values (default,?,?)");
            $stmt->bind_param("si", $this->NomeTurma, $this->Ano);
            return $stmt->execute();
        }

        public function AlterarTurma()
        {
            $stmt = $this->banco->getConexao()->prepare("update turma set NomeTurma = ?, Ano = ? where idturma = ?");
            $stmt->bind_param("sii", $this->NomeTurma, $this->Ano, $this->idTurma);
            return $stmt->execute();
        }

        public function ExcluirTurma()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from turma where idturma = ?");
            $stmt->bind_param("i", $this->idTurma);
            return $stmt->execute();
        }

        public function ConsultarUmaTurma($idTurma)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from turma where idturma = ?");
            $stmt->bind_param("i", $idTurma);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()){
                $this->setIdTurma($linha->idturma);
                $this->setNomeTurma($linha->turma);
                $this->setAno($linha->ano);
            }
            return $this;
        }

        public function ConsultarTurmas()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from turma order by ano desc, turma asc");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorTurmas = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorTurmas[$i] = new Turma();
                $vetorTurmas[$i]->setIdTurma($linha->idturma);
                $vetorTurmas[$i]->setNomeTurma($linha->turma);
                $vetorTurmas[$i]->setAno($linha->ano);
                $i++;
            }
            return $vetorTurmas;
        }


        public function setIdTurma($idTurma)
        {
                $this->idTurma = $idTurma;

                return $this;
        }
        public function getIdTurma()
        {
                return $this->idTurma;
        }

        public function setNomeTurma($NomeTurma)
        {
            $this->NomeTurma = $NomeTurma;
            return $this;
        }
        public function getNomeTurma()
        {
            return $this->NomeTurma;
        }


        public function setAno($Ano)
        {
            $this->Ano = $Ano;
            return $this;
        }
        public function getAno()
        {
            return $this->Ano;
        }
    }

?>