<?php
    session_start();
    require_once("./Classes/Usuario.php");
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
        <link rel="stylesheet" href="index.css">



        <title>Cadastro de Turmas</title>
    </head>
    <body>

        <?php
            $msg = "";
            $msgTitulo = "";
            $msgSubtitulo = "";
            $msgTexto = "";
            $msgCoAutor1 = "";
            $msgCoAutor2 = "";
            $msgCoAutor3 = "";
            $msgCoAutor4 = "";
            $msgFoto1 = "";
            $msgFoto2 = "";
            $msgFoto3 = "";
            $titulo = "";
            $subtitulo = "";
            $texto = "";
            $CoAutor1 = "";
            $CoAutor2 = "";
            $CoAutor3 = "";
            $CoAutor4 = "";

            if (isset($_GET["msg"])){
                $msg = $_GET["msg"];
            }
            if (isset($_GET["msgTitulo"])){
                $msgTitulo = $_GET["msgTitulo"];
            }
            if (isset($_GET["msgSubtitulo"])){
                $msgSubtitulo = $_GET["msgSubtitulo"];
            }
            if (isset($_GET["msgTexto"])){
                $msgTexto = $_GET["msgTexto"];
            }
            if (isset($_GET["msgCoAutor1"])){
                $msgCoAutor1 = $_GET["msgCoAutor1"];
            }
            if (isset($_GET["msgCoAutor2"])){
                $msgCoAutor2 = $_GET["msgCoAutor2"];
            }
            if (isset($_GET["msgCoAutor3"])){
                $msgCoAutor3 = $_GET["msgCoAutor3"];
            }
            if (isset($_GET["msgCoAutor4"])){
                $msgCoAutor4 = $_GET["msgCoAutor4"];
            }
            if (isset($_GET["msgFoto1"])){
                $msgFoto1 = $_GET["msgFoto1"];
            }
            if (isset($_GET["msgFoto2"])){
                $msgFoto2 = $_GET["msgFoto2"];
            }
            if (isset($_GET["msgFoto3"])){
                $msgFoto3 = $_GET["msgFoto3"];
            }
            if (isset($_GET["titulo"])){
                $titulo = $_GET["titulo"];
            }
            if (isset($_GET["subtitulo"])){
                $subtitulo = $_GET["subtitulo"];
            }
            if (isset($_SESSION["texto"])){
                $texto = $_SESSION["texto"];
                
            }
            if (isset($_GET["CoAutor1"])){
                $CoAutor1 = $_GET["CoAutor1"];
            }
            if (isset($_GET["CoAutor2"])){
                $CoAutor2 = $_GET["CoAutor2"];
            }
            if (isset($_GET["CoAutor3"])){
                $CoAutor3 = $_GET["CoAutor3"];
            }
            if (isset($_GET["CoAutor4"])){
                $CoAutor4 = $_GET["CoAutor4"];
            }


        ?>

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
                        <a class="nav-link text-white" href="./CadastrarTurma.php">Cadastrar Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarTipoPost.php">Cadastrar Tipos de Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./Destinos/PostsDestino.php">Veja os posts dos seus amigos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./ProcurarUsuarios.php">Procure Usuarios!</a>
                    </li>
                </ul>
                <img class="rounded-circle" src="./Imagens/<?php echo $usuario->getFoto()?>" alt="" width="80px">
            </div>
        </nav>
        <br>
        <br>
        <div class="sombra container mt-3 b">
            <h2>Faça um post</h2>
            <p>Selecione seu tipo de post e seja criativo &#128522.</p>
            <form action="./Controles/ControlePosts.php" method="post" enctype="multipart/form-data">
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="titulo" placeholder="Digite o Titulo" name="titulo" value="<?php echo $titulo?>" required> 
                    <label for="titulo">Titulo</label>
                    <span id="validação"><i><u><?php echo $msgTitulo;?></u></i></span>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="subtitulo" placeholder="Digite o Subtitulo" name="subtitulo" value="<?php echo $subtitulo?>" required> 
                    <label for="subtitulo">Subtitulo</label>
                    <span id="validação"><i><u><?php echo $msgSubtitulo;?></u></i></span>
                </div>
                <div class="mb-3 mt-3">
                    <label for="texto">Texto:</label>
                    <textarea class="form-control" rows="3" id="texto" name="texto" required maxlength="500"><?php echo $texto; unset($_SESSION["texto"]);?></textarea>
                    <span id="validação"><i><u><?php echo $msgTexto;?></u></i></span>
                </div>
                <p>Você pode fazer upload de até 3 fotos:</p>
                <div class="form-floating mt-3 mb-3">
                    <input type="file" class="form-control" id="imagem1" placeholder="Imagem1" name="imagem1">
                    <span id="validação"><i><u><?php echo $msgFoto1;?></u></i></span>
                    <label for="imagem1">1° Imagem</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="file" class="form-control" id="imagem2" placeholder="Imagem2" name="imagem2">
                    <span id="validação"><i><u><?php echo $msgFoto2;?></u></i></span>
                    <label for="imagem2">2° Imagem</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="file" class="form-control" id="imagem3" placeholder="Imagem3" name="imagem3">
                    <span id="validação"><i><u><?php echo $msgFoto3;?></u></i></span>
                    <label for="imagem3">3° Imagem</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <select class="form-select" class="form-control" id="tipoPost" placeholder="Selecione o Tipo de Post" name="tipoPost"required>
                        <?php
                            include "./Classes/TipoPost.php";
                            $TipoPost = new TipoPost();
                            $vetorTiposPost = $TipoPost->ConsultarTiposDePost();
                            for ($i = 0; $i < count($vetorTiposPost); $i++){
                                echo '<option value='. $vetorTiposPost[$i]->getIdTipoPost() .'>'. $vetorTiposPost[$i]->getTipo() .'</option>';
                            }
                        ?>
                    </select>
                    <label for="TipoPost">Selecione o Tipo de Post</label>
                </div>
                <p>Você pode adicionar até 4 co-autores digitando seus emails: </p>
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="coAutor1" name="coAutor1" value="<?php echo $CoAutor1?>">
                    <label for="coAutor1">1° CoAutor:</label>
                    <span id="validação"><i><u><?php echo $msgCoAutor1;?></u></i></span>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="coAutor2" name="coAutor2" value="<?php echo $CoAutor2?>">
                    <label for="coAutor2">2° CoAutor:</label>
                    <span id="validação"><i><u><?php echo $msgCoAutor2;?></u></i></span>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="coAutor3" name="coAutor3" value="<?php echo $CoAutor3?>">
                    <label for="coAutor3">3° CoAutor:</label>
                    <span id="validação"><i><u><?php echo $msgCoAutor3;?></u></i></span>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="coAutor4" name="coAutor4" value="<?php echo $CoAutor4?>">
                    <label for="coAutor4">4° CoAutor:</label>
                    <span id="validação"><i><u><?php echo $msgCoAutor4;?></u></i></span>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn bg-blue btn-primary btn-block"><b>Postar</b></button>
                </div>
                <br>
                <span id="validação"><i><u><?php echo $msg?></u></i></span>
                <br>
            </form>
        </div>
        </form>
        <div class="mt-5 p-4 bg-dark text-white text-center">
            <h1>Projeto feito por Miguel Brito, Lucas Maia, Agnes Bakos - 2°FID</h1>
        </div>
    </body>
</html>