<?php
    class Banco{
        private $host = "127.0.0.1";
        private $usuario = "root";
        private $senha = "";
        private $banco = "Clinica_veterinaria_db";
        private $porta = "3306";
        private $con=null;

        private function Conectar(){
            $this->con = new mysqli($this->host, $this->usuario, $this->senha, $this->banco, $this->porta);
            if ($this->con->connect_error){
                die("Falha na conexão" . $this->con->connect_error);
            }
        }

        public function GetConexão()
        {
            if ($this->con==null){
                $this->Conectar();
            }
            return $this->con;
        }
    }
?>