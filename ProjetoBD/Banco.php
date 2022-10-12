<?php
    
    class Banco{
        private $host = "127.0.0.1";
        private $root = "root";
        private $senha = "";
        private $banco = "Cartao";
        private $porta = "3306";
        private $con = null;
        
        
        private function Conectar()
        {
            $this->con = new mysqli($this->host, $this->root, $this->senha, $this->banco, $this->porta);
            if ($this->con->connect_error){
                die("Falha na conexão. ". $this->con->connect_error);
            }
        }

        public function getConexão()
        {
            if ($this->con == null){
                $this->Conectar();
            }
            return $this->con;
        }
    }

?>