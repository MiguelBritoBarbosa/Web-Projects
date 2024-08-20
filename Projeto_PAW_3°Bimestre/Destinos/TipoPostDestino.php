<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        
        include "../Classes/Usuario.php";
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
    <link rel="stylesheet" href="../index.css">
    <title>Turma Cadastrada!</title>
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
                <?php
                        if(!isset($_SESSION["usuario"])){
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="../index.php">Página Inicial</a>';
                            echo '</li>';
                        }
                        else{
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="../index.php">Sair</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="./indexDestino.php">Página Principal</a>';
                            echo '</li>';
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION["usuario"])){
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="../CadastrarUsuario.php">Cadastrar-se</a>';
                            echo '</li>';
                        }
                        else{
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="../ProcurarUsuarios.php">Procure Usuarios</a>';
                            echo '</li>';
                        }
                    ?>
                    <?php
                        if(isset($_SESSION["usuario"])){
                            echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="../Posts.php">Comece a postar</a>';
                            echo '</li>';
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../CadastrarTurma.php">Cadastre uma turma</a>
                    </li>
                </ul>
            </div>
            <img class="rounded-circle" src="../Imagens/<?php if(isset($_SESSION["usuario"])){echo $usuario->getFoto();} ?>" alt="" width="80px">
        </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="sombra container mt-3 b">
        <h1>Cadastro de Turma</h1>
        <br>
        <h2>Tipo de Post "<?php echo $_GET["tipoPost"];?>" cadastrado com sucesso!</h2>
        <br>
    </div>
</body>
</html>