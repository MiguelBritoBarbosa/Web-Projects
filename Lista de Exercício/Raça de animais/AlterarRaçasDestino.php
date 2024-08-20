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
    <h1 align="center">Alterar a Raça do Animal</h1>
    <hr>
    <?php
      $contador = 0;
      if (isset($_GET["IdRaçaAnimal"])){
        include "../Conexão.php";
        $banco = new Banco();
        $Id = $_GET["IdRaçaAnimal"];
        
        $sql = "select * from RacaAnimal;";
        if ($resutado = $banco->GetConexão()->query($sql)){
          while ($linha = $resutado->fetch_object()){
            if ($Id == $linha->idRacaAnimal){
            $contador = 1;
            }
          }
          if ($contador == 0){
            echo "<a href='TabelaDeRaças.php'>Tabela de raça de animais</a><br>";
            die("Id não encontrado");
          }

          $TipoRaçaAlterado = $_GET["TipoRaçaAlterado"];
          $TipoRaçaAlterado = strip_tags($TipoRaçaAlterado);
          if ($TipoRaçaAlterado != ""){
            while ($linha = $resutado->fetch_object()){
              if ($TipoRaçaAlterado == $linha->tipo){
                echo "<a href='TabelaDeRaças.php'>Tabela de raça de animais</a><br>";
                die("Tipo de animal já cadastrado!");
              }
              $TipoAnimal = $linha->tipo;
            }
    
            $stmt = $banco->GetConexão()->prepare("update RacaAnimal set raça = ? where idRacaAnimal = ?");
            $stmt->bind_param("si", $TipoAnimal, $Id);
            $stmt->execute();
    
            echo "Alteração feita com sucesso!";
          }else{
            echo "Raça de Animal a ser alterado não foi inserido";
          }
        }
      }else{
        echo "Responda o formulário!";
      }
      $banco->GetConexão()->close();
    ?>
    <br>
    <a href="TabelaDeRaças.php">Tabela de raça de animais</a>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>
  </body>
</html>
