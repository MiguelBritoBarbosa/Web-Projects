<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        
        include "./Classes/Usuario.php";
        $usuario = new Usuario();
        $idUsuario = $_SESSION["usuario"];
        $usuario = $usuario->ConsultarUmUsuario($idUsuario);
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
        <link rel="stylesheet" href="index.css">



        <title>Cadastro de Turmas</title>
    </head>
    <body>

        <?php
            $msg = "";
            $msgTurma = "";
            $msgAno = "";
            $turma = "";
            $ano = "";
            if (isset($_GET["msg"])){
                $msg = $_GET["msg"];
            }
            if (isset($_GET["msgTurma"])){
                $msgTurma = $_GET["msgTurma"];
            }
            if (isset($_GET["msgAno"])){
                $msgAno = $_GET["msgAno"];
            }
            if (isset($_GET["turma"])){
                $turma = $_GET["turma"];
            }
            if (isset($_GET["ano"])){
                $ano = $_GET["ano"];
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
                    <?php
                        if(!isset($_SESSION["usuario"])){
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./index.php">Página Inicial</a>';
                            echo '</li>';
                        }
                        else{
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./index.php">Sair</a>';
                            echo '</li>';
                            
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./Destinos/indexDestino.php">Página Principal</a>';
                            echo '</li>';
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION["usuario"])){
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./CadastrarUsuario.php">Cadastrar-se</a>';
                            echo '</li>';
                        }
                        else{
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./ProcurarUsuarios.php">Procure Usuarios</a>';
                            echo '</li>';
                        }
                    ?>
                    <?php
                        if(isset($_SESSION["usuario"])){
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./Posts.php">Comece a postar</a>';
                            echo '</li>';
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarTipoPost.php">Cadastre um tipo de Post</a>
                    </li>
                </ul>
                <img class="rounded-circle" src="./Imagens/<?php if(isset($_SESSION["usuario"])){echo $usuario->getFoto();} ?>" alt="" width="80px">
            </div>
        </nav>
        <br>
        <br>
        <div class="sombra container mt-3 b">
            <h2>Cadastre uma Turma</h2>
            <p>Digite a turma e seu respectivo ano. Exemplo (2°F / 2).</p>
            <form action="./Controles/ControleTurmas.php" method="post">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="turma" placeholder="Digite a Turma" name="turma" maxlength="3" value="<?php echo $turma?>" required>
                    <label for="turma">Turma</label>
                    <span id="validação"><i><u><?php echo $msgTurma;?></u></i></span>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="ano" placeholder="Digite o Ano" name="ano" maxlength="1" value="<?php echo $ano?>" required> 
                    <label for="ano">Ano</label>
                    <span id="validação"><i><u><?php echo $msgAno;?></u></i></span>
                </div>
                <button type="submit" class="btn bg-blue btn-primary">Submit</button>
                <br>
                <span id="validação"><i><u><?php echo $msg?></u></i></span>
                <br>
            </form>
        </div>
        </form>
    </body>
</html>