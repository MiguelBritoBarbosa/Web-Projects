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
    <h1 align="center">Inserir Raças de Animal</h1>
    <hr>
    <?php
      if (isset($_GET["TipoAnimal"])){

        $TipoAnimal = $_GET["TipoAnimal"];
        $RaçaAnimal = $_GET["RaçaAnimal"];
        if ($TipoAnimal != "" && $RaçaAnimal != ""){
          $RaçaAnimal = strip_tags($RaçaAnimal);
          include "../Conexão.php";
          $banco = new Banco();
          $sql = "select * from RacaAnimal;";
          if ($resutado = $banco->GetConexão()->query($sql)){
            while ($linha = $resutado->fetch_object()){
              if ($RaçaAnimal == $linha->raça && $TipoAnimal == $linha->TipoAnimal_idTipoAnimal){
                echo "<a href='TabelaDeRaças.php'>Tabela de raça de animais</a><br>";
                die("Tipo de raça já cadastrada!");
              }
            }
          }
          $stmt = $banco->GetConexão()->prepare("insert into RacaAnimal(idRacaAnimal, raça, TipoAnimal_idTipoAnimal) values (default, ?, ?)");
          $stmt->bind_param("si", $RaçaAnimal, $TipoAnimal);
          $stmt->execute();
          echo "Cadastro feito com sucesso";
          echo "<br><a href='TabelaDeRaças.php'>Tabela de raça de animais</a>";
        }else{
          echo "Falta informações!";
        }
        
      }else{
        echo "Responda o formulário!";
      }
      $banco->GetConexão()->close();
    ?>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>
    <br>
  </body>
</html>
