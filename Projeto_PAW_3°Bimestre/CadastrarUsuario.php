<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="index.css">



    <title>Cadastro de Usuarios</title>
</head>

<body>

    <?php
        $msg = "";
        $msgNome = "";
        $msgEmail = "";
        $msgSenha = "";
        $msgDataNasci = "";
        $msgFoto = "";
        $nome = "";
        $email = "";
        $senha = "";
        if (isset($_GET["msg"])){
            $msg = $_GET["msg"];
        }
        if (isset($_GET["msgNome"])){
            $msgNome = $_GET["msgNome"];
        }
        if (isset($_GET["msgEmail"])){
            $msgEmail = $_GET["msgEmail"];
        }
        if (isset($_GET["msgSenha"])){
            $msgSenha = $_GET["msgSenha"];
        }
        if (isset($_GET["msgDataNasci"])){
            $msgDataNasci = $_GET["msgDataNasci"];
        }
        if(isset($_GET["msgFoto"])){
            $msgFoto = $_GET["msgFoto"];
        }
        if (isset($_GET["nome"])){
            $nome = $_GET["nome"];
        }
        if (isset($_GET["email"])){
            $email = $_GET["email"];
        }
        if (isset($_GET["senha"])){
            $senha = $_GET["senha"];
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
                    <a class="nav-link text-white" href="./index.php">Página Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./CadastrarTurma.php">Cadastrar turma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./CadastrarTipoPost.php">Cadastrar Tipo de Post</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <br>
    <div class="sombra container mt-3 b">
        <h2>Cadastre-se</h2>
        <p>Digite suas informações para realizar o cadastro.</p>
        <form action="./Controles/ControleUsuario.php" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="nome" placeholder="Digite a Nome" name="nome" value="<?php echo $nome?>" required>
                <label for="turma">Nome</label>
                <span id="validação"><i><u><?php echo $msgNome;?></u></i></span>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="email" class="form-control" id="email" placeholder="Digite o Email" name="email" value="<?php echo $email?>" required>
                <label for="ano">Email</label>
                <span id="validação"><i><u><?php echo $msgEmail;?></u></i></span>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="password" class="form-control" id="senha" placeholder="Digite o Senha" name="senha" value="<?php echo $senha?>" required>
                <label for="ano">Senha</label>
                <span id="validação"><i><u><?php echo $msgSenha;?></u></i></span>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="file" class="form-control" id="foto" placeholder="Foto" name="foto">
                <span id="validação"><i><u><?php echo $msgFoto;?></u></i></span>
                <label for="foto">Escolha uma foto de perfil</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="date" class="form-control" id="dataNasci" placeholder="Data de Nascimento" name="dataNasci"required>
                <label for="dataNasci">Data de nascimento</label>
                <span id="validação"><i><u><?php echo $msgDataNasci;?></u></i></span>
            </div>
            <div class="form-floating mt-3 mb-3">
                <select class="form-select" class="form-control" id="turma" placeholder="Selecione a Turma" name="turma"required>
                    <?php
                        include "./Classes/Turmas.php";
                        $Turmas = new Turma();
                        $vetorTurmas = $Turmas->ConsultarTurmas();
                        for ($i = 0; $i < count($vetorTurmas); $i++){
                            echo '<option value='. $vetorTurmas[$i]->getIdTurma() .'>'. $vetorTurmas[$i]->getNomeTurma() .'</option>';
                        }
                    ?>
                </select>
                <label for="turma">Selecione a turma</label>
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