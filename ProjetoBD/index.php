<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://plentz.github.io/jquery-maskmoney/javascripts/jquery.maskMoney.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="./index.css">

    <title>Cartão de Crédito</title>


    <?php
    $msg = "";
    $nome = "";
    $idade = "";
    $celular = "";
    $email = "";
    $cpf = "";
    $SerasaScore = "";
    $salario = "";


    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
    }
    if (isset($_GET["nome"])) {
        $nome = $_GET["nome"];
    }
    if (isset($_GET["idade"])) {
        $idade = $_GET["idade"];
    }
    if (isset($_GET["celular"])) {
        $celular = $_GET["celular"];
    }
    if (isset($_GET["email"])) {
        $email = $_GET["email"];
    }
    if (isset($_GET["cpf"])) {
        $cpf = $_GET["cpf"];
    }
    if (isset($_GET["Sscore"])) {
        $SerasaScore = $_GET["Sscore"];
    }
    if (isset($_GET["salario"])) {
        $salario = $_GET["salario"];
    }
    ?>


    <script>
        function mascara(i) {

            var v = i.value;

            if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
                i.value = v.substring(0, v.length - 1);
                return;
            }

            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";

        }

        function mask(o, f) {
            setTimeout(function() {
                var v = mphone(o.value);
                if (v != o.value) {
                    o.value = v;
                }
            }, 1);
        }

        function mphone(v) {
            var r = v.replace(/\D/g, "");
            r = r.replace(/^0/, "");
            if (r.length > 10) {
                r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (r.length > 5) {
                r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (r.length > 2) {
                r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
                r = r.replace(/^(\d*)/, "($1");
            }
            return r;
        }

        jQuery(function() {

            jQuery("#salario").maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ','
            })

        });
    </script>


</head>

<body>

    <div class="offcanvas offcanvas-start" id="demo">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Cadastre-se</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form action="./ControleCartão.php" id="form" method="post">
                <p>Digite seu nome completo:</p>
                <div class="form-floating mb-2 mt-2">
                    <input onblur="ValidarNome()" type="text" class="form-control required" id="nome" placeholder="Enter name" name="nome" value="<?php echo $nome ?>">
                    <label for="nome">Nome</label>
                    <span class="validação" style="display: none;">Nome inválido</span>
                </div>
                <p>Digite sua idade:</p>
                <div class="form-floating mb-2 mt-2">
                    <input onblur="ValidarIdade()" type="text" class="form-control required" id="idade" placeholder="Enter age" name="idade" value="<?php echo $idade ?>" maxlength="3">
                    <label for="nome">Idade</label>
                    <span class="validação" style="display: none;">Idade inválida</span>
                </div>
                <p>Digite seu número de celular:</p>
                <div class="form-floating mb-2 mt-2">
                    <input onblur="ValidarCelular()" type="text" class="form-control required" id="celular" placeholder="Enter cell" name="celular" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" value="<?php echo $celular ?>" maxlength="15">
                    <label for="celular">Celular</label>
                    <span class="validação" style="display: none;">Número de celular inválido</span>
                </div>
                <p>Digite seu email:</p>
                <div class="form-floating mb-2 mt-2">
                    <input onblur="ValidarEmail()" type="text" class="form-control required" id="email" placeholder="Enter email" name="email" value="<?php echo $email ?>">
                    <label for="email">Email</label>
                    <span class="validação" style="display: none;">Email inválido</span>
                </div>
                <p>Digite seu cpf:</p>
                <div class="form-floating mb-2 mt-2">
                    <input oninput="mascara(this)" onblur="ValidarCPF()" type="text" class="form-control required" id="cpf" placeholder="Enter cpf" name="cpf" maxlength="11" value="<?php echo $cpf ?>">
                    <label for="cpf">CPF</label>
                    <span class="validação" style="display: none;">CPF inválido</span>
                </div>
                <p>Digite seu Serasa Score:</p>
                <div class="form-floating mb-2 mt-2">
                    <input onblur="ValidarSscore()" type="text" class="form-control required" id="Sscore" placeholder="Enter Score" name="Sscore" value="<?php echo $SerasaScore ?>" maxlength="4">
                    <label for="Sscore">Serasa Score</label>
                    <span class="validação" style="display: none;">Serasa Score inválido</span>
                </div>
                <p>Digite seu Salário:</p>
                <div class="form-floating mb-2 mt-2">
                    <input onblur="ValidarSalario()" type="text" class="form-control required" id="salario" placeholder="Enter Salary" name="salario" value="<?php echo $salario ?>" maxlength="16">
                    <label for="salario">Salário</label>
                    <span class="validação" style="display: none;">Salário inválido</span>
                </div>
                <div class="form-check mb-2">
                    <label class="form-check-label">
                        <input class="form-check-input required" type="checkbox" name="remember" onchange="ValidarCheck()"> Aceito os termos
                        <span class="validação" style="display: none;">Aceite os termos</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-dark">Cadastrar-se</button>
                <?php
                    echo $msg;
                ?>
            </form>
        </div>
    </div>

    <div class="p-5 bg-purple text-white text-center">
        <h1>Peça já seu cartão do Banco 2°FID</h1>
    </div>
    <div class="p-3 bg-dark text-white text-center">
        <img src="./Fotos/pc.jpg" style="width:40px;" class="float-end rounded-pill">
        <img src="./Fotos/informática.png" style="width:60px;" class="float-end rounded">
        <img src="./Fotos/univap.jpg" style="width:100px;" class="float-start ">
        <h2>Univap - Informática</h2>
    </div>

    <div style="width: 1200px;" class="sombra container mt-5 bg-purple rounded-1">
        <img src="./Fotos/FrenteCartão.png" class="img-fluid m-5 rounded">
        <img src="./Fotos/Verso.png" class="img-fluid m-5 rounded">

    </div>


    <div class="sombra container mt-5 bg-purple rounded-1 text-white">
        <div class="row">
            <div class="col-sm-4">
                <h2>Vantagens</h2>
                <ul>
                    <li><b>Segurança padrão univap.</b></li>
                    <li><b>Limite 1.6x maior que seu salário</b></li>
                    <li><b>pode entrar “no vermelho” até 15% do valor do limite.</b></li>
                </ul>

            </div>
            <div class="col-sm-8">
                <h2>Pré-requisitos</h2>
                <h5>Existem algumas regras para se obter nosso cartão.</h5>
                <p>Eles são:</p>
                <ul>
                    <li><b>Ser maior de 16 anos.</b></li>
                    <li><b>Possuir um Serasa Score acima de quinhetos.</b></li>
                </ul>
            </div>
        </div>
        <br>
        <div class="d-grid">
            <button type="button" id="cadastro" class="btn btn-dark btn-block m-3" data-bs-toggle="offcanvas" data-bs-target="#demo">Peça já o seu!</button>
        </div>
    </div>

    <div class="mt-5 p-4 bg-dark text-white text-center">
        <h1>Projeto feito por Miguel Brito, Lucas Maia, Agnes Bakos - 2°FID</h1>
    </div>

    <script>
        const botão = document.getElementById('cadastro');
        var msg = "<?= $msg ?>";

        if (msg != "") {
            botão.click();
        }
    </script>

    <script src="./validação.js"></script>

</body>

</html>