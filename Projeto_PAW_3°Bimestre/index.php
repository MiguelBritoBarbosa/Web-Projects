<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="index.css">
    

        <title>UniPosts</title>
    </head>

    <body>

        <?php
            session_start();
            session_unset();
            session_destroy();
            $msg = "";
            $email = "";
            $senha = "";

            if (isset($_GET["msg"])){
                $msg = $_GET["msg"];
            }
            if (isset($_GET["email"])){
                $email = $_GET["email"];
            }
            if (isset($_GET["senha"])){
                $senha = $_GET["senha"];
            }

        ?>

        <div class="bg-gray offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title text-white">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <form action="./Controles/ControleLogin.php" method="post">
                    <p class="text-white">Digite seu email:</p>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email?>" required>
                        <label for="email">Email</label>
                        <span id="validação"><i><u><?php echo $msg;?></u></i></span>
                    </div>

                    <p class="text-white">Digite sua senha:</p>
                    <div class="form-floating mt-3 mb-3">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="senha" value="<?php echo $senha?>" required>
                        <label for="pwd">Password</label>
                        <span id="validação"><i><u><?php echo $msg;?></u></i></span>
                    </div>
                    <input type="submit" class="btn bg-blue text-white bg-primary">
                </form>
            </div>
        </div>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <img class="navbar-brand" src="./Imagens/logo-colegios-univap.jpg" alt="Logo">
            </div>
        </nav>
        
        <nav class="navbar navbar-expand-sm bg-blue navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarUsuario.php">Cadastrar-se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarTurma.php">Cadastrar turma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./CadastrarTipoPost.php">Cadastre um tipo de post</a>
                    </li>
                </ul>
                <button type="button" id="login" class="btn bg-red text-white btn-danger" data-bs-toggle="offcanvas" data-bs-target="#demo"><b>Login</b></button>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <center>
        <h1>UNIPOSTS</h1>
        </center>
        
        <div class="fixarRodape mt-5 p-4 bg-dark text-white text-center">
            <h1>Projeto feito por Miguel Brito, Lucas Maia, Agnes Bakos - 2°FID</h1>
        </div>
    </body>

    <script>
        const botão = document.getElementById('login');
        var msg = "<?= $msg ?>";

        if (msg != "") {
            botão.click();
        }
    </script>

</html>