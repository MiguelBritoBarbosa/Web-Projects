<?php
    session_start();
    include "../Classes/Usuario.php";
    if(isset($_SESSION["usuario"])){
        
        $usuario = new Usuario();
        $idUsuario = $_SESSION["usuario"];
        $usuario = $usuario->ConsultarUmUsuario($idUsuario);
    }
    else{
        $idUsuario = $_GET["idUsuario"];
        $_SESSION["usuario"] = $idUsuario;
    }
    $usuario = new Usuario();
    $usuario = $usuario->ConsultarUmUsuario($idUsuario);


?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../index.css">
    

        <title>UniPosts</title>
    </head>

    <body>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <img class="navbar-brand" src="../Imagens/logo-colegios-univap.jpg" alt="Logo">
            </div>
        </nav>
        <nav class="navbar navbar-expand-sm bg-blue navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../index.php">Sair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../CadastrarTurma.php">Cadastrar turma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../CadastrarTipoPost.php">Cadastre um tipo de post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../Posts.php">Comece a postar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./PostsDestino.php">Veja os posts dos seus amigos!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../ProcurarUsuarios.php">Procure novos usuários!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../UsuariosSeguidos.php">Veja o perfil de seus amigos!</a>
                    </li>
                </ul>
                <img class="rounded-circle" src="../Imagens/<?php echo $usuario->getFoto()?>" alt="" width="80px">
            </div>
        </nav>


    </body>

</html>