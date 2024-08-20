<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content=" width=device-width, initialscale=1.0">
  <title>php</title>
  <style type="text/css">
    h1{
      font-size: 52px;
      font-family: calibri;
    }
    hr{
      height: 6px;
      background-color: black;
    }
  </style>
  </head>
  <body>
    <h1 align="center">Inserir Donos de Animal</h1>
    <hr>
    <?php
        $nome = $_GET["nome"];
        $email = $_GET["email"];
        $cpf = $_GET["cpf"];
        $telefone = $_GET["telefone"];
        $celular = $_GET["celular"];
        $logradouro = $_GET["logradouro"];
        $numero = $_GET["numero"];
        $complemento = $_GET["complemento"];
        $bairro = $_GET["bairro"];
        $estado = $_GET["estado"];
        include "../Conexão.php";

        $banco = new Banco();
        $sql = "select * from DonoAnimal;";
        if ($resutado = $banco->GetConexão()->query($sql)){
          while ($linha = $resutado->fetch_object()){
            if ($cpf == $linha->cpf){
                echo "<a href='../PáginaPrincipal.html'>Página Principal</a><br>";
                die("Cpf já cadastrado!");
            }
            else if($email == $linha->email){
                echo "<a href='T../PáginaPrincipal.html'>Página Principal</a><br>";
                die("Email já cadastrado!");
            }
          }
        }
        $stmt = $banco->GetConexão()->prepare("insert into DonoAnimal (idDonoAnimal, nome, email, cpf, telefone, celular, logradouro, numero, complemento, bairro, estado) values(default, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiisisss", $nome, $email, $cpf, $telefone, $celular, $logradouro, $numero, $complement,$bairro, $estado);
        $stmt->execute();
        echo "Cadastro feito com sucesso";
    ?>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>
  </body>
</html>