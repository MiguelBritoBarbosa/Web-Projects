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
    <h1 align="center">Inserir Tipos de Animal</h1>
    <hr>
    <?php
      if (isset($_GET["TipoAnimal"])){

        $TipoAnimal = $_GET["TipoAnimal"];
        if ($TipoAnimal != ""){
          $TipoAnimal = strip_tags($TipoAnimal);
          include "../Conexão.php";
          $banco = new Banco();
          $sql = "select * from TipoAnimal;";
          if ($resutado = $banco->GetConexão()->query($sql)){
            while ($linha = $resutado->fetch_object()){
              if ($TipoAnimal == $linha->tipo){
                echo "<a href='TabelaDeTipos.php'>Tabela de tipo de animais</a><br>";
                die("Tipo de animal já cadastrado!");
              }
            }
          }
          $stmt = $banco->GetConexão()->prepare("insert into TipoAnimal(idTipoAnimal, tipo) values (default, ?)");
          $stmt->bind_param("s", $TipoAnimal);

          $stmt->execute();
          echo "Cadastro feito com sucesso";
          echo "<br><a href='TabelaDeTipos.php'>Tabela de tipo de animais</a>";
        }else{
          echo "Falta informações!";
        }
        
      }else{
        echo "Responda o formulário!";
      }
    ?>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>
  </body>
</html>
