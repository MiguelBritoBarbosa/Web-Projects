<?php

    require_once("Banco.php");

    class Seguidor{
        private $usuario_idusuario_Seguido;
        private $usuario_idusuario_Seguidor;
        private $banco;
        function __construct() {
            $this->banco = new Banco();
        }

    
        public function CadastrarSeguidor()
        {
            $stmt = $this->banco->getConexao()->prepare("Insert into seguidor values (?,?)");   
            $stmt->bind_param("ii", $this->usuario_idusuario_Seguido, $this->usuario_idusuario_Seguidor);
            return $stmt->execute();
        }


        public function ExcluirSeguidor()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from seguidor where usuario_idusuario_seguido = ? and usuario_idusuario_seguidor = ?");
            $stmt->bind_param("ii", $this->usuario_idusuario_Seguido, $this->usuario_idusuario_Seguidor);
            return $stmt->execute();
        }

        public function ConsultarUmSeguidor($usuario_idusuario_Seguidor, $usuario_idusuario_Seguido)
        {
            $stmt = $this->banco->getConexao()->prepare("select count(*) as qtd from seguidor where usuario_idusuario_Seguidor = ? and usuario_idusuario_Seguido = ?");
            $stmt->bind_param("ii", $usuario_idusuario_Seguidor, $usuario_idusuario_Seguido);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if($resultado->fetch_object()->qtd > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function ConsultarSeguidores()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from seguidor");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorPost_Fotos = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorPost_Fotos[$i] = new PostFotos();
                $vetorPost_Fotos[$i]->setUsuario_idUsuario($linha->usuario_idusuario);
                $vetorPost_Fotos[$i]->setPost_idPost($linha->post_idpost);
                $i++;
            }
            return $vetorPost_Fotos;
        }


       

        public function setUsuario_idusuario_Seguido($usuario_idusuario_Seguido)
        {
            $this->usuario_idusuario_Seguido = $usuario_idusuario_Seguido;
            return $this;
        }
        public function getUsuario_idusuario_Seguido()
        {
            return $this->usuario_idusuario_Seguido;
        }

        public function setUsuario_idusuario_Seguidor($usuario_idusuario_Seguidor)
        {
            $this->usuario_idusuario_Seguidor = $usuario_idusuario_Seguidor;
            return $this;
        }
        public function getUsuario_idusuario_Seguidor()
        {
            return $this->usuario_idusuario_Seguidor;
        }
    }
?>