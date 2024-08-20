<?php

    require_once("Banco.php");

    class AutoresPost{
        private $Usuario_idUsuario;
        private $Post_idPost;
        private $banco;
        function __construct() {
            $this->banco = new Banco();
        }

    
        public function CadastrarAutoresPost()
        {
            $stmt = $this->banco->getConexao()->prepare("Insert into autorespost values (?,?)");
            $stmt->bind_param("ii", $this->Usuario_idUsuario, $this->Post_idPost);
            return $stmt->execute();
        }


        public function ExcluirAutoresPost()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from autorespost where usuario_idusuario = ?");
            $stmt->bind_param("i", $this->usuario_idusuario);
            return $stmt->execute();
        }

        public function ConsultarUmPostAutores($Post_idPost)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from autorespost where post_idpost = ?");
            $stmt->bind_param("i", $Post_idPost);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorPost_Fotos[$i] = new AutoresPost();
                $vetorPost_Fotos[$i]->setUsuario_idUsuario($linha->usuario_idusuario);
                $vetorPost_Fotos[$i]->setPost_idPost($linha->post_idpost);
                $i++;
            }
            return $vetorPost_Fotos;
        }

        public function ConsultarAutoresPosts()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from autorespost");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorPost_Fotos = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorPost_Fotos[$i] = new AutoresPost();
                $vetorPost_Fotos[$i]->setUsuario_idUsuario($linha->usuario_idusuario);
                $vetorPost_Fotos[$i]->setPost_idPost($linha->post_idpost);
                $i++;
            }
            return $vetorPost_Fotos;
        }


        public function setUsuario_idUsuario($Usuario_idUsuario)
        {
            $this->Usuario_idUsuario = $Usuario_idUsuario;
            return $this;
        }
        public function getUsuario_idUsuario()
        {
            return $this->Usuario_idUsuario;
        }

        public function setPost_idPost($Post_idPost)
        {
            $this->Post_idPost = $Post_idPost;
            return $this;
        }
        public function getPost_idPost()
        {
            return $this->Post_idPost;
        }
    }
?>