<?php

    require_once("Banco.php");

    class Usuario{
        private $idUsuario;
        private $Nome;
        private $Email;
        private $Senha;
        private $foto;
        //private $long;
        private $DataNascimento;
        private $turma_id;
        private $banco;
        function __construct()
        {
            $this->banco = new Banco();
        }


        public function CadastrarUsario()
        {
            $stmt = $this->banco->getConexao()->prepare("insert into usuario (idusuario, nome, email, senha, foto, dataNascimento, turma_idturma) values(default,?,?,?,?,?,?)");
            echo gettype($stmt);
            $stmt->bind_param("sssssi", $this->Nome, $this->Email, $this->Senha, $this->foto, $this->DataNascimento, $this->turma_id);
            return $stmt->execute();
        }

        public function AlterarUsuario()
        {
            $stmt = $this->banco->getConexao()->prepare("alter usuario set nome = ?, email = ?, senha = ?, foto = ?, dataNascimento = ?, turma_idturma = ? where idusuario = ?");
            $stmt->bind_param("sssssii", $this->Nome, $this->Email, $this->Senha, $this->foto, $this->DataNascimento, $this->turma_id, $this->idUsuario);
            return $stmt->execute();
        }

        public function ExcluirUsuario()
        {
            $stmt = $this->banco->getConexao()->prepare("delete from usuario where idusuario = ?");
            $stmt->bind_param("i", $this->idUsuario);
            return $stmt->execute();
        }

        public function ConsultarUmUsuario($idUsuario)
        {
            $stmt = $this->banco->getConexao()->prepare("select * from usuario where idusuario = ?");
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()){
                $this->setIdUsuario($linha->idusuario);
                $this->setNome($linha->nome);
                $this->setEmail($linha->email);
                $this->setSenha($linha->senha);
                $this->setFoto($linha->foto);
                $this->setDataNascimento($linha->dataNascimento);
                $this->setTurma_id($linha->turma_idturma);
            }
            return $this;
        }

        public function ConsultarUsuarios()
        {
            $stmt = $this->banco->getConexao()->prepare("select * from usuario");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $vetorUsuarios = array();
            $i = 0;
            while($linha = mysqli_fetch_object($resultado)){
                $vetorUsuarios[$i] = new Usuario();
                $vetorUsuarios[$i]->setIdUsuario($linha->idusuario);
                $vetorUsuarios[$i]->setNome($linha->nome);
                $vetorUsuarios[$i]->setEmail($linha->email);
                $vetorUsuarios[$i]->setSenha($linha->senha);
                $vetorUsuarios[$i]->setFoto($linha->foto);
                $vetorUsuarios[$i]->setDataNascimento($linha->dataNascimento);
                $vetorUsuarios[$i]->setTurma_id($linha->turma_idturma);
                $i++;
            }
            return $vetorUsuarios;
        }

        public function setIdUsuario($idUsuario)
        {
            $this->idUsuario = $idUsuario;
            return $this;
        }
        public function getIdUsuario()
        {
            return $this->idUsuario;
        }

        public function setNome($Nome)
        {
            $this->Nome = $Nome;
            return $this;
        }
        public function getNome()
        {
            return $this->Nome;
        }

        public function setEmail($Email)
        {
            $this->Email = $Email;
            return $this;
        }
        public function getEmail()
        {
            return $this->Email;
        }

        public function setSenha($Senha)
        {
            $this->Senha = $Senha;
            return $this;
        }
        public function getSenha()
        {
            return $this->Senha;
        }

        public function setFoto($foto)
        {
            $this->foto = $foto;
            return $this;
        }
        public function getFoto()
        {
            return $this->foto;
        }

        /*public function setLong($long)
        {
            $this->long = $long;
            return $this;
        }
        public function getLong()
        {
            return $this->long;
        }
        */
        public function setDataNascimento($DataNascimento)
        {
            $this->DataNascimento = $DataNascimento;
            return $this;
        }
        public function getDataNascimento()
        {
            return $this->DataNascimento;
        }

        public function setTurma_id($turma_id)
        {
            $this->turma_id = $turma_id;
            return $this;
        }
        public function getTurma_id()
        {
            return $this->turma_id;
        }
    }


?>