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
      .input1{
        width: 220px;
        margin-right: 10px;
    }
    </style>
  </head>
  <body>
    <?php
      $msg = "";
      $nome = "";
      $email = "";
      $cpf = "";
      $telefone = "";
      $celular = "";
      $logradouro = "";
      $numero = "";
      $complemento = "";
      $bairro = "";
      $estado = "";
      if(isset($_GET["msg"])){
        $msg = $_GET["msg"];
      }
      if(isset($_GET["nome"])){
        $nome = $_GET["nome"];
      }
      if(isset($_GET["email"])){
        $email = $_GET["email"];
      }
      if(isset($_GET["cpf"])){
        $cpf = $_GET["cpf"];
      }
      if(isset($_GET["telefone"])){
        $telefone = $_GET["telefone"];
      }
      if(isset($_GET["celular"])){
        $celular = $_GET["celular"];
      }
      if(isset($_GET["logradouro"])){
        $logradouro = $_GET["logradouro"];
      }
      if(isset($_GET["numero"])){
        $numero = $_GET["numero"];
      }
      if(isset($_GET["complemento"])){
        $complemento = $_GET["complemento"];
      }
      if(isset($_GET["bairro"])){
        $bairro = $_GET["bairro"];
      }
      if(isset($_GET["estado"])){
        $estado = $_GET["estado"];
      }
    ?>


    <h1 align="center">Cadastro de tipo de Animal</h1>
    <hr>
    <h3>Digite as Informações</h3>
    <form action="./Controle_CadastroDono.php" method="get">
      <input type="text" name="nome" value="<?php echo $nome?>" placeholder="Digite o nome do dono">
      <br>
      <input type="email" name="email" value="<?php echo $email?>" placeholder="Digite o email do dono">
      <br>
      <input type="text" name="cpf" value="<?php echo $cpf?>" placeholder="Digite o cpf do dono" maxlength="11">
      <br>
      <input type="tel" name="telefone" value="<?php echo $telefone?>" placeholder="Digite o número de telefone do dono" class="input1">
      <br>
      <input type="tel" name="celular" value="<?php echo $celular?>" placeholder="Digite o número de celular do dono" class="input1">
      <br>
      <input type="text" name="logradouro" value="<?php echo $logradouro?>" placeholder="Digite o logradouro">
      <br>
      <input type="text" name="numero" value="<?php echo $numero?>" placeholder="Digite o número da casa">
      <br>
      <input type="text" name="complemento" value="<?php echo $complemento?>" placeholder="Complemento">
      <br>
      <input type="text" name="bairro" value="<?php echo $bairro?>" placeholder="Digite o Bairro">
      <br>
      <select name="estado" value="<?php echo $estado?>">
      <option value="">Selecione</option>
        <option value="AC" checked>Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapá</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="ES">Esprírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG">Minas Gerais</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
        <option value="DF">Distrito Federal</option>
      </select>
      <br>
      <br>
      <input type="submit">
    </form>
    
    <a href="../PáginaPrincipal.html">Página Principal</a>
    <br>
    <?php
      echo $msg;
    ?>
  </body>
</html>