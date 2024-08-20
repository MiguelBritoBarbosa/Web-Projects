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
    <h1 align="center">Tabela dos Tipos de Animal</h1>
    <hr>
    <?php
      include "../Conexão.php";
      $banco = new Banco();
      $sql = "select * from TipoAnimal order by tipo;";
      if ($resutado = $banco->GetConexão()->query($sql)){
        $tabela = "<table border='1'>";
            $tabela .= "<tr>";
              $tabela .= "<th colspan='2'>Tipo de Animal</th>";
            $tabela .= "</tr>";

            $tabela .= "<tr>";
          while ($linha = $resutado->fetch_object()){
              $tabela .= "<td>$linha->idTipoAnimal</td>";
              $tabela .= "<td>$linha->tipo</td>";
            $tabela .= "</tr>";
          }
            $tabela .= "<tr>";
              $tabela .= "<td colspan='2'><a href='AlterarTipos.html'>Alterar Tipos</a></td>";
            $tabela .= "</tr>";
            $tabela .= "<tr>";
              $tabela .= "<td colspan='2'><a href='ExclusãoDeTipo.html'>Excluir Tipos</a></td>";
            $tabela .= "</tr>";
          echo $tabela;
      }
    ?>
    
  <a href="TipoAnimal.html">inserir mais tipo de animais</a>
  <br>
  <br>
  <a href="../PáginaPrincipal.html">Página Principal</a>
  </body>
</html>
