<?php

    require_once("Banco.php");

    class Comentario{
        private $idComentario;
        private $Comentario;
        private $Nota;
        private $Post_idPost;
        private $Usuario_idUsuario;
        private $banco;
        function __construct() {
            $this->banco = new Banco();
        }

    
        public function CadastrarComentario()
        {
            $stmt = $this->banco->getConexao()->prepare("insert into comentario values (default,?,?,?,?)");
            $stmt->bind_param("siii", $this->Comentario, $this->Nota, $this->Post_idPost, $this->Usuario_idUsuario);
            return $stmt->execute();
        }

        public function AlterarComentario()
        {
            $stmt = $this->banco->getConexao()->prepare("update turma set comentario = ?, nota = ? where post_idpost = ? and usuario_idusuario = ?");
            $stmt->bind_param("sii", $this->Comentario, $this->Nota, $this->Post_idPost, $this->Usuario_idUsuario);
            return $stmt->execute();
        }

        public function ExcluirComentario()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from comentario where idcomentario = ?");
            $stmt->bind_param("i", $this->idComentario);
            return $stmt->execute();
        }

        public function ConsultarUmComentario($idComentario)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from comentario where idcomentario = ?");
            $stmt->bind_param("i", $idComentario);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()){
                $this->setIdComentario($linha->idcomentario);
                $this->setComentario($linha->comentario);
                $this->setNota($linha->nota);
            }
            return $this;
        }

        public function ConsultarComentarios()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from comentario");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorTurmas = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)){
                $vetorTurmas[$i] = new Comentario();
                $vetorTurmas[$i]->setIdComentario($linha->idcomentario);
                $vetorTurmas[$i]->setComentario($linha->comentario);
                $vetorTurmas[$i]->setNota($linha->nota);
                $vetorTurmas[$i]->setPost_idPost($linha->post_idpost);
                $vetorTurmas[$i]->setUsuario_idUsuario($linha->usuario_idusuario);
                $i++;
            }
            return $vetorTurmas;
        }


        public function setIdComentario($idComentario)
        {
            $this->idComentario = $idComentario;
            return $this;
        }
        public function getIdComentario()
        {
            return $this->idComentario;
        }

        public function setComentario($Comentario)
        {
            $this->Comentario = $Comentario;
            return $this;
        }
        public function getComentario()
        {
            return $this->Comentario;
        }

        public function setNota($Nota)
        {
            $this->Nota = $Nota;
            return $this;
        }
        public function getNota()
        {
            return $this->Nota;
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

        public function setUsuario_idUsuario($Usuario_idUsuario)
        {
            $this->Usuario_idUsuario = $Usuario_idUsuario;
            return $this;
        }
        public function getUsuario_idUsuario()
        {
            return $this->Usuario_idUsuario;
        }
    }

?>