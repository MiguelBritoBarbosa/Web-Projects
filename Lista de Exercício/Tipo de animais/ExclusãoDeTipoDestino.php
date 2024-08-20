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
    <h1 align="center">Excluir o Tipo Animal</h1>
    <hr>
    <?php
      $contador = 0;
      if (isset($_GET["IdTipoAnimal"])){
        include "../Conexão.php";
        $banco = new Banco();
        $Id = $_GET["IdTipoAnimal"];
        if ($Id != ""){

          $sql = "select * from racaanimal;";

          if($resultado = $banco->GetConexão()->query($sql)){
            while ($linha = $resultado->fetch_object()){
              if ($Id == $linha->TipoAnimal_idTipoAnimal){
                $stmt = $banco->GetConexão()->prepare("delete from racaanimal where TipoAnimal_idTipoAnimal = ?");
                $stmt->bind_param("i", $Id);
                $stmt->execute  ();
                echo "Exclusão de raça feita<br>";
              }
            }
          }





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
  
  
            $stmt = $banco->GetConexão()->prepare("delete from tipoanimal where idTipoAnimal = ?");
            $stmt->bind_param("i", $Id);
            $stmt->execute();
  
            echo "Exclusão feita com sucesso!";
          }
        }else{
          echo "Falta informações";
        }
      }else{
        echo "Responda o formulário";
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
