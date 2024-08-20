<?php
    require_once("Banco.php");

    class Post{
        private $idPost;
        private $mometo;
        private $post;
        private $titulo;
        private $subtitulo;
        private $tipoPost_idTipoPost;
        private $banco;
        function __construct()
        {
            $this->banco = new Banco();
        }


        public function CadastrarPost()
        {
            $stmt = $this->banco->getConexao()->prepare("insert into post values(?, ?,?,?,?,?)");
            $stmt->bind_param("issssi",$this->idPost, $this->mometo, $this->post, $this->titulo, $this->subtitulo, $this->tipoPost_idTipoPost);
            return $stmt->execute();
        }

        public function AlterarPost()
        {
            $stmt = $this->banco->getConexao()->prepare("alter post set momento = ?, post = ?, titulo = ?, subtitulo = ?, tipoPost_idtipoPost = ? where idpost = ?");
            $stmt->bind_param("ssssii", $this->mometo, $this->post, $this->titulo, $this->subtitulo, $this->tipoPost_idTipoPost, $this->idPost);
            return $stmt->execute();
        }
        
        public function ExcluirPost()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from post where idpost = ?");
            $stmt->bind_param("i", $this->idPost);
            return $stmt->execute();
        }

        public function ConsultarUmPost($idPost)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from post where idpost = ?");
            $stmt->bind_param("i", $idPost);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()){
                $this->setIdPost($linha->idpost);
                $this->setMometo($linha->momento);
                $this->setPost($linha->post);
                $this->setTitulo($linha->titulo);
                $this->setSubtitulo($linha->subtitulo);
                $this->setTipoPost_idTipoPost($linha->tipoPost_idtipoPost);
            }
            return $this;
        }

        public function ConsultarPosts()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from post order by momento desc");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorPosts = array();
            $i = 0;
            while($linha = mysqli_fetch_object($resultado)){
                $vetorPosts[$i] = new Post();
                $vetorPosts[$i]->setIdPost($linha->idpost);
                $vetorPosts[$i]->setMometo($linha->momento);
                $vetorPosts[$i]->setPost($linha->post);
                $vetorPosts[$i]->setTitulo($linha->titulo);
                $vetorPosts[$i]->setSubtitulo($linha->subtitulo);
                $vetorPosts[$i]->setTipoPost_idTipoPost($linha->tipoPost_idtipoPost);
                $i++;
            }
            return $vetorPosts;
        }


        public function setIdPost($idPost)
        {
            $this->idPost = $idPost;
            return $this;
        }
        public function getIdPost()
        {
            return $this->idPost;
        }

        public function setMometo($mometo)
        {
            $this->mometo = $mometo;
            return $this;
        }
        public function getMometo()
        {
            return $this->mometo;
        }

        public function setPost($post)
        {
            $this->post = $post;
            return $this;
        }
        public function getPost()
        {
            return $this->post;
        }
        
        public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
            return $this;
        }
        public function getTitulo()
        {
            return $this->titulo;
        }

        public function setSubtitulo($subtitulo)
        {
            $this->subtitulo = $subtitulo;
            return $this;
        }
        public function getSubtitulo()
        {
            return $this->subtitulo;
        }

        public function setTipoPost_idTipoPost($tipoPost_idTipoPost)
        {
            $this->tipoPost_idTipoPost = $tipoPost_idTipoPost;
            return $this;
        }
        public function getTipoPost_idTipoPost()
        {
            return $this->tipoPost_idTipoPost;
        }
    }
?>