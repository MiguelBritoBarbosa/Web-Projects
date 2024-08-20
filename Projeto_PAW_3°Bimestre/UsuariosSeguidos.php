<?php

use function PHPSTORM_META\elementType;

    session_start();
    require_once("./Classes/Usuario.php");
    require_once("./Classes/Turmas.php");
    require_once("./Classes/Seguidor.php");
    $usuario = new Usuario();
    $idUsuario = $_SESSION["usuario"];

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
        <link rel="stylesheet" href="./index.css">


        <title>UniPosts</title>
    </head>

    <body>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <img class="navbar-brand" src="./Imagens/logo-colegios-univap.jpg" alt="Logo">
            </div>
        </nav>
        <nav class="navbar navbar-expand-sm bg-blue navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./index.php">Sair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./Destinos/indexDestino.php">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarTurma.php">Cadastrar turma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarTipoPost.php">Cadastre um tipo de post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./Posts.php">Faça um post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./Destinos/PostsDestino.php">Veja os posts dos seus amigos!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./ProcurarUsuarios.php">Procure Usuários!</a>
                    </li>
                </ul>
                <img src="./Imagens/<?php echo $usuario->getFoto()?>" alt="" width="80px" class="rounded-circle">
            </div>
        </nav>
        <div class="sombra container mt-3 ">
            <h1>Amigos:</h1>
            <br>




            <?php
            $seguidos = 0;
                $OutrosUsuarios = $usuario->ConsultarUsuarios();
                for ($i=0; $i < count($OutrosUsuarios); $i++){
                    $seguir = new Seguidor();
                    $seguindo = $seguir->ConsultarUmSeguidor($idUsuario, $OutrosUsuarios[$i]->getIdUsuario());
                    
                    if ($seguindo == true){
                        if ($idUsuario != $OutrosUsuarios[$i]->getIdUsuario()){
                            echo '<div class="p-4 container user bg-hover-color text-center ">';
                                
                                echo '<div class=" bg-hover-color card" style="width:400px">';
                                    echo '<img class="card-img-top" src="./Imagens/'. $OutrosUsuarios[$i]->getFoto() .'" alt="Card image" style="width:100%">';
                                    echo '<div class="card-body">';
                                        echo '<h4 class="card-title">'. $OutrosUsuarios[$i]->getNome() .'</h4>';
                                        $turma = new Turma();
                                        $turma->ConsultarUmaTurma($OutrosUsuarios[$i]->getTurma_id());
                                    
                                        echo '<h5 class="card-text">Do: '. $turma->getNomeTurma() .'</h5>';
                                        
                                        echo '<form action="Seguir.php" method="post">';
                                            echo '<input name="deseguir" type="hidden" value="'. $OutrosUsuarios[$i]->getIdUsuario() .'">';
                                            echo '<input name="PaginaDestino" type="hidden" value="./UsuariosSeguidos.php">';
                                            echo '<button type="submit" class="btn bg-red btn-danger btn-block"><b>Deseguir</b></button>';
                                        echo '</form>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div><br>'; 
                            $seguidos++;
                        }
                    }
                }
                if ($seguidos == 0){
                    echo '<div class="justify-content-center bg-hover-color text-center">';
                        echo '<div class="row">';
                            echo "<h3>Você ainda não segue ninguem! Faça novos amigos!</h3>";
                        echo "</div>";
                    echo "</div>";
                    echo "<br>";
                }
                
            ?>
        <form action="Seguir.php" target="iframe">

        </form>
        </div>
        <br>
        <div  class=" mt-5 p-4 bg-dark text-white text-center">
            <h1>Projeto feito por Miguel Brito, Lucas Maia, Agnes Bakos - 2°FID</h1>
        </div>
    </body>

</html>