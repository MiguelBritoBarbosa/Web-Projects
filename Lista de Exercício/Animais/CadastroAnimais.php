<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Miguel Brito Barbosa</title>
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
    <?php
      $nome = "";
      $chip = "";
      $nasci = "";
      $sexo = "";
      $cpf = "";
      $msg = "";

      if (isset($_GET["nomeAnimal"])){
        $nome = $_GET["nomeAnimal"];
      }
      if (isset($_GET["chipID"])){
        $chip = $_GET["chipID"];
      }
      if (isset($_GET["nascimento"])){
        $nasi = $_GET["nascimento"];
      }
      if (isset($_GET["sexo"])){
        $sexo = $_GET["sexo"];
      }
      if (isset($_GET["cpf"])){
        $cpf = $_GET["cpf"];
      }
      if (isset($_GET["msg"])){
        $msg = $_GET["msg"];
      }

    ?>
    <h1 align="center">Cadastro de Animal</h1>
    <hr>
    <h3>Digite as Informações</h3>
    <form action="ControleCadastroAnimal.php" method="GET">
        <input type="text" name="nomeAnimal" placeholder="Digite o nome do animal" value="<?php echo $nome?>">
        <br>
        <br>
        <input type="text" name="chipID" placeholder="Digite o ChipID" value="<?php echo $chip?>">
        <br>
        <br>
        <input type="date" name="nascimento" placeholder="Data de Nascimento" value="<?php echo $nasci?>">
        <br>
        <br>
        <input type="texte" name="sexo" placeholder="Digite o sexo do animal" maxlength="1" value="<?php echo $sexo?>">
        <br>
        <br>
        <?php
          $contador = 0;
          include "../Conexão.php";
          $banco = new Banco();
          $Raças = array();
          $IdRaças = array();
          $Donos = array();
          $IdDonos = array();
          $sql = "select * from RacaAnimal order by raça;";
          if ($resultado = $banco->GetConexão()->query($sql)){
              while ($linha = $resultado->fetch_object()){
                  array_push($Raças, $linha->raça);
                  array_push($IdRaças, $linha->idRacaAnimal);
                  $contador ++;
              }
          }
          $options = array();
          for ($i = 0; $i < $contador; $i++){
          array_push($options, "<option value='$IdRaças[$i]'>$Raças[$i]</option>");
          }

          echo "<h4>Selecione a Raça do animal para cadastra-lo</h4>";

          echo "<select name='RacaAnimal'>";
            echo "<option>Selecionar</option>";
            for ($i = 0; $i < $contador; $i++){
              echo $options[$i];
            }
            echo "</select>";
        ?>
        <br>
        <br>
        <input type="text" name="cpf"  placeholder="Digite o cpf do dono" maxlength="11" value="<?php echo $cpf?>">
        <br>
        <br>
        <input type="submit">
    </form>
    <?php
      echo $msg;
    ?>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>

  </body>
</html>