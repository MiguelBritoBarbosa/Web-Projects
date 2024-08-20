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
    <h1 align="center">Alterar o Tipo Animal</h1>
    <hr>
    <?php
      $contador = 0;
      if (isset($_GET["IdTipoAnimal"])){
        include "../Conexão.php";
        $banco = new Banco();
        $Id = $_GET["IdTipoAnimal"];
        
        $sql = "select * from TipoAnimal;";
        if ($resutado = $banco->GetConexão()->query($sql)){
          while ($linha = $resutado->fetch_object()){
            if ($Id == $linha->idTipoAnimal){
            $contador = 1;
            }
          }
          if ($contador == 0){
            echo "<a href='TabelaDeTipos.php'>Tabela de tipo de animais</a><br>";
            die("Id não encontrado");
          }
  
          $TipoAnimalAlterado = $_GET["TipoAnimalAlterado"];
          $TipoAnimalAlterado = strip_tags($TipoAnimalAlterado);
          if ($TipoAnimalAlterado != ""){
            while ($linha = $resutado->fetch_object()){
              if ($TipoAnimalAlterado == $linha->tipo){
                echo "<a href='TabelaDeTipos.php'>Tabela de tipo de animais</a><br>";
                die("Tipo de animal já cadastrado!");
              }
              $TipoAnimal = $linha->tipo;
            }
    
            $stmt = $banco->GetConexão()->prepare("update TipoAnimal set tipo = ? where idTipoAnimal = ?");
            $stmt->bind_param("si", $TipoAnimalAlterado, $Id);
            $stmt->execute();
    
            echo "Alteração feita com sucesso!";
          }else{
            echo "Tipo de Animal a ser alterado não foi inserido";
          }
        }
      }else{
        echo "Responda o formulário!";
      }
      $banco->GetConexão()->close();
    ?>
    <br>
    <a href="TabelaDeTipos.php">Tabela de tipo de animais</a>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>

  </body>
</html>
