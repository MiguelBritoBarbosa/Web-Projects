<?php
    session_start();
    include "../Classes/Usuario.php";
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
    <link rel="stylesheet" href="../index.css">
    <title>Posts</title>
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
                    <a class="nav-link text-white" href="../CadastrarTipoPost.php">Cadastre mais tipos de post!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../CadastrarTurma.php">Cadastre mais uma turma!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../Posts.php">Poste mais!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../ProcurarUsuarios.php">Procure usuários!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../UsuariosSeguidos.php">Veja o perfil dos seus amigos!</a>
                </li>
            </ul>
            <img class="rounded-circle" src="../Imagens/<?php echo $usuario->getFoto()?>" alt="" width="80px">
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="sombra container mt-3">
        <h1>Posts da Galera:</h1>
        <br>
    
        <?php
            include "../Classes/Post.php";
            include "../Classes/PostFotos.php";
            include "../Classes/AutoresPost.php";
            include "../Classes/Seguidor.php";
            $seguidor = new Seguidor();
            $Post = new Post();
            $PostFotos = new PostFotos();
            $AutoresPost = new AutoresPost();
            $vetorPosts = $Post->ConsultarPosts();
            $vetorFotos = $PostFotos->ConsultarPostsFotos();
            $NumSeguindo = 0;
            for ($i = 0; $i < count($vetorPosts); $i++){
                
                $vetorAutores = $AutoresPost->ConsultarUmPostAutores($vetorPosts[$i]->getIdPost());
                
                for ($x=0; $x < count($vetorAutores); $x++){
                    $seguido = $seguidor->ConsultarUmSeguidor($idUsuario, $vetorAutores[$x]->getUsuario_idUsuario());
                
                    if ($seguido == true){
                        echo '<div class="postagem justify-content-center bg-hover-color text-center">';
                        echo '<div class="row">';
                            echo '<a href="../PostUsuario.php?idpost='.$vetorPosts[$i]->getIdPost().'"><h3>'. $vetorPosts[$i]->getTitulo() .'</h3></a>';
                            
                            echo "<h4><p>". $vetorPosts[$i]->getPost() ."</p></h4>";
                            
                        echo "</div>";
                        for ($x=0; $x < count($vetorFotos); $x++){
                            if ($vetorFotos[$x]->getPost_idPost() == $vetorPosts[$i]->getIdPost()){
                                echo "<img src='../Imagens/". $vetorFotos[$x]->getFoto() ."' width='150px' class='img-thumbnail'>";
                                echo "<br><br>";
                                break;
                            }
                        }
                    echo "</div>";
                    echo "<br>";    
                    $NumSeguindo++;
                    break;
                }
                }
            }
            if ($NumSeguindo == 0){
                echo '<div class="justify-content-center bg-hover-color text-center">';
                    echo '<div class="row">';
                        echo "<h3>Você ainda não segue ninguem! Faça novos amigos!</h3>";
                    echo "</div>";
                echo "</div>";
            }

        
        ?>
        <br>
    </div>
    <br>
    <div class="Rodape mt-5 p-4 bg-dark text-white text-center">
        <h1>Projeto feito por Miguel Brito, Lucas Maia, Agnes Bakos - 2°FID</h1>
    </div>
</body>
</html>