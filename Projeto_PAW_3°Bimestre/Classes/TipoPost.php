<?php
    require_once("Banco.php");

    class TipoPost{
        private $idTipoPost;
        private $Tipo;
        private $banco;
        function __construct()
        {
            $this->banco = new Banco();
        }


        public function CadastrasTipoPost()
        {
            $stmt = $this->banco->getConexao()->prepare("insert into tipopost values (default,?)");
            $stmt->bind_param("s", $this->Tipo);
            return $stmt->execute();
        }

        public function AlterarTipoPost()
        {
            $stmt = $this->banco->getConexao()->prepare("alter tipopost set tipo = ? where idtipoPost = ?");
            $stmt->bind_param("si", $this->Tipo, $this->idTipoPost);
            return $stmt->execute();
        }

        public function ExcluirTipoPosto()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from tipopost where idtipoPost = ?");
            $stmt->bind_param("i", $this->idTipoPost);
            return $stmt->execute();
        }

        public function ConsultarUmTipoPost($idTipoPost)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from tipopost where idtipoPost = ?");
            $stmt->bind_param("i", $idTipoPost);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()){
                $this->setIdTipoPost($linha->idtipoPost);
                $this->setTipo($linha->tipo);
            }
            return $this;
        }

        public function ConsultarTiposDePost()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from tipopost");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorTiposPost = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorTiposPost[$i] = new TipoPost();
                $vetorTiposPost[$i]->setIdTipoPost($linha->idtipoPost);
                $vetorTiposPost[$i]->setTipo($linha->tipo);
                $i++;
            }
            return $vetorTiposPost;
        }
        


        public function setIdTipoPost($idTipoPost)
        {
            $this->idTipoPost = $idTipoPost;
            return $this;
        }
        public function getIdTipoPost()
        {
            return $this->idTipoPost;
        }

        public function setTipo($Tipo)
        {
            $this->Tipo = $Tipo;
            return $this;
        }

        public function getTipo()
        {
            return $this->Tipo;
        }
    }




?>