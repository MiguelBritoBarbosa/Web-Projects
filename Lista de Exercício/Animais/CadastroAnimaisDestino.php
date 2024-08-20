<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=" width=device-width, initialscale=1.0">
    <title>php</title>
    <style type="text/css">
      h1 {
        font-size: 52px;
        font-family: calibri;
      }

      hr {
        height: 6px;
        background-color: black;
      }
    </style>
  </head>

  <body>
    <h1 align="center">Inserir Animais</h1>
    <hr>
    <?php
    $nome = $_GET['nomeAnimal'];
    $chip = $_GET['chipID'];
    $nasci = $_GET['nascimento'];
    $sexo = $_GET['sexo'];
    $IdRaça = $_GET['RacaAnimal'];
    $cpf = $_GET['cpf'];
    $dono = false;

    include "../Conexão.php";

    $banco = new Banco();
    $sql = "select * from donoanimal;";
    if ($resutado = $banco->GetConexão()->query($sql)) {
      while ($linha = $resutado->fetch_object()) {
        if ($cpf == $linha->cpf) {
          $dono = true;
          $idDono = $linha->idDonoAnimal;
          break;
        }
        else{
          continue;
        }
      }
    }
    $banco->GetConexão()->close();
    $banco = new Banco();
    if ($dono == true){
      $sql = "select * from animal;";
      if ($resutado = $banco->GetConexão()->query($sql)){
        while ($linha = $resutado->fetch_object()){
          if ($linha->chipID == $chip){
            die("Animal já cadastrado!");
          }
        }
      }
    }
    $stmt = $banco->GetConexão()->prepare("insert into Animal values(default, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissii", $nome, $chip, $nasci, $sexo, $IdRaça, $idDono);
    $stmt->execute();
    echo "Cadastro feito com sucesso!";
    ?>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>
  </body>
</html>