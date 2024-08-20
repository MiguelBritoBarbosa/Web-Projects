<?php

    require_once("Banco.php");

    class PostFotos{
        private $Post_idPost;
        private $Foto;
        private $banco;
        function __construct() {
            $this->banco = new Banco();
        }

    
        public function CadastrarPostFotos()
        {
            $stmt = $this->banco->getConexao()->prepare("Insert into post_fotos values (?,?)");
            $stmt->bind_param("is", $this->Post_idPost, $this->Foto);
            return $stmt->execute();
        }

        public function AlterarPostFotos()
        {
            $stmt = $this->banco->getConexao()->prepare("update post_fotos set foto = ? where post_idpost = ?");
            $stmt->bind_param("si", $this->Foto, $this->Post_idPost);
            return $stmt->execute();
        }

        public function ExcluirPostFotos()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from post_fotos where post_idpost = ?");
            $stmt->bind_param("i", $this->Post_idPost);
            return $stmt->execute();
        }

        public function ConsultarUmPostFotos($Post_idPost)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from post_fotos where post_idpost = ?");
            $stmt->bind_param("i", $Post_idPost);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $i = 0;
            $vetorFotos = array();
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorFotos[$i] = new PostFotos();
                $vetorFotos[$i]->setPost_idPost($linha->post_idpost);
                $vetorFotos[$i]->setFoto($linha->foto);
                $i++;
            }
            return $vetorFotos;
        }

        public function ConsultarPostsFotos()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from post_fotos");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorPost_Fotos = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorPost_Fotos[$i] = new PostFotos();
                $vetorPost_Fotos[$i]->setPost_idPost($linha->post_idpost);
                $vetorPost_Fotos[$i]->setFoto($linha->foto);
                $i++;
            }
            return $vetorPost_Fotos;
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

        public function setFoto($Foto)
        {
            $this->Foto = $Foto;
            return $this;
        }
        public function getFoto()
        {
            return $this->Foto;
        }
    }

?>