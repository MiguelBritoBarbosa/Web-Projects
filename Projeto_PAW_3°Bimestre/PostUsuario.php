<?php
    session_start();
    include "./Classes/Usuario.php";
    $usuario = new Usuario();
    $idUsuario = $_SESSION["usuario"];    
    $usuario = $usuario->ConsultarUmUsuario($idUsuario);

    $msg = "";
    $msgComentario = "";
    $comentario = "";
    $msgNota = "";

    if(isset($_GET["comentario"])){
        $comentario = $_GET["comentario"];
    }
    if(isset($_GET["msgComentario"])){
        $msgComentario = $_GET["msgComentario"];
    }
    if(isset($_GET["msg"])){
        $msg = $_GET["msg"];
    }
    if(isset($_GET["msgNota"])){
        $msgNota = $_GET["msgNota"];
    }

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
    <title>Posts</title>
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
                    <a class="nav-link text-white" href="./Destinos/indexDestino.php">Página Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./CadastrarTipoPost.php">Cadastre mais tipos de post!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./Posts.php">Poste mais!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./ProcurarUsuarios.php">Procure usuários!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./Destinos/PostsDestino.php">Veja os posts dos seus amigos!</a>
                </li>
            </ul>
           <img class="rounded-circle" src="./Imagens/<?php echo $usuario->getFoto()?>" alt="" width="80px">
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="sombra container mt-3">
        
        <?php
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            include "./Classes/Post.php";
            include "./Classes/TipoPost.php";
            include "./Classes/PostFotos.php";
            include "./Classes/AutoresPost.php";
            $AutorPost = new AutoresPost();
            $TipoPost = new TipoPost();
            $Post = new Post();
            $PostFotos = new PostFotos();
            

            $idPost = $_GET['idpost'];
            $vetorAutores = $AutorPost->ConsultarUmPostAutores($idPost);
           
            $DonoPost = new Usuario();
            $DonoPost->ConsultarUmUsuario($AutorPost->getUsuario_idUsuario());
            if (count($vetorAutores) == 1){
                $DonoPost->ConsultarUmUsuario($vetorAutores[0]->getUsuario_idUsuario());
                echo "<h1>Autor do Post: ". $DonoPost->getNome() ."</h1><br>";
            }
            else{
                echo "<h2>Autores do Post: "; 
                for ($i=0; $i < count($vetorAutores); $i++){
                    $DonoPost->ConsultarUmUsuario($vetorAutores[$i]->getUsuario_idUsuario());
                    echo $DonoPost->getNome() . " | ";                    

                }
                echo "</h2><br>";           
            }


            $Post->ConsultarUmPost($idPost);

            $TipoPost->ConsultarUmTipoPost($Post->getTipoPost_idTipoPost());

            $vetorFotos = $PostFotos->ConsultarUmPostFotos($Post->getIdPost());
        
            echo '<div class="postagemSolo justify-content-center bg-hover-color text-center">';
                echo '<div class="row">';
                    echo "<h3>". $Post->getTitulo() ." | Post de: ". $TipoPost->getTipo() ."</h3>";
                    echo "<h4>". $Post->getSubtitulo() ."</h3>";
                    echo "<h5><p>". $Post->getPost() ."</p></h5>";
                    echo "</div>";
                    if (count($vetorFotos) != 0){
                        for ($i=0; $i < count($vetorFotos); $i++){
                            echo '<img class="img-thumbnail" src="./Imagens/'. $vetorFotos[$i]->getFoto() .'" width="300px" >';    
                        }
                        
                    }
                    echo utf8_encode("<p>Postado no: " . strftime('%A, dia %d de %B de %Y as %R', strtotime($Post->getMometo())) ."</p>");
                
            echo "</div>";
            



        
        
        ?>
        <br>
        
        <h2>Comentarios: </h2>

        <?php
            include "./Classes/Comentario.php";
            $Comentario = new Comentario();
            
            $vetorComentarios = $Comentario->ConsultarComentarios();
            $Usuarios = new Usuario();
            $vetorUsuarios = $Usuarios->ConsultarUsuarios();
            for ($i=0; $i < count($vetorComentarios); $i++){
                if ($vetorComentarios[$i]->getPost_idPost() == $Post->getIdPost()){
                    echo "<div class='comentario bg-hover-color'>";
                        for ($x=0; $x < count($vetorUsuarios); $x++){
                            if ($vetorUsuarios[$x]->getIdUsuario() == $vetorComentarios[$i]->getUsuario_idUsuario()){
                                echo '<img class="rounded-circle" src="./Imagens/'. $vetorUsuarios[$x]->getFoto() .'" width="50px" >';    
                            }
                        }
                        echo $vetorComentarios[$i]->getComentario();
                        echo "<br>Nota: ";
                        for ($x=0; $x < $vetorComentarios[$i]->getNota(); $x++){
                            echo "&#11088";
                        }
                        
                        echo "<br>";
                    echo "</div>";
                    echo "<br>";
                }
                
            }
        
        
        ?>

        <h3>Faça um comentario: </h3>
        
        <form action="./Controles/ControleComentario.php" method="post">
            <input type="hidden" name="idPost" value="<?php echo $idPost?>">
            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario?>">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="comentario" placeholder="Digite a Turma" name="comentario" maxlength="45" value="<?php echo $comentario?>" required>
                    <label for="comentario">Comentario</label>
                    <span id="validação"><i><u><?php echo $msgComentario;?></u></i></span>
                </div>
                <label for="nota" class="form-label">Selecione uma nota:</label>
                <select class="form-select form-select-lg " name="nota">
                    <option valeu="0">De uma nota!</option>
                    <option value="1">&#11088</option>
                    <option value="2">&#11088&#11088</option>
                    <option value="2">&#11088&#11088&#11088</option>
                    <option value="4">&#11088&#11088&#11088&#11088</option>
                    <option value="5">&#11088&#11088&#11088&#11088&#11088</option>
                </select>
                <span id="validação"><i><u><?php echo $msgNota;?></u></i></span>
                <br>
                <button type="submit" class="btn bg-blue btn-primary">Submit</button>
                <br>
                <span id="validação"><i><u><?php echo $msg?></u></i></span>
                <br>
        </form>
        

    </div>
    <br>
    <div class="Rodape mt-5 p-4 bg-dark text-white text-center">
        <h1>Projeto feito por Miguel Brito, Lucas Maia, Agnes Bakos - 2°FID</h1>
    </div>
</body>
</html>