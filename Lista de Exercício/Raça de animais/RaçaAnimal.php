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
    <h1 align="center">Cadastro de Raças de Animal</h1>
    <hr>
    <h3>Digite as Informações</h3>
    <?php
        $contador = 0;
        include "../Conexão.php";
        $banco = new Banco();
        $Tipos = array();
        $IdTipos = array();
        $sql = "select * from TipoAnimal;";
        if ($resultado = $banco->GetConexão()->query($sql)){
            while ($linha = $resultado->fetch_object()){
                array_push($Tipos, $linha->tipo);
                array_push($IdTipos, $linha->idTipoAnimal);
                $contador += 1;
            }
        }
        $options = array();
        for ($i = 0; $i < $contador; $i++){
            array_push($options, "<option value='$IdTipos[$i]'>$Tipos[$i]</option>");
        }
        echo "<h4>Selecione o Tipo do animal para inserir a raça</h4>";

        echo "<form action='RaçaAnimalDestino.php' method='get'>";
            echo "<select name='TipoAnimal'>";
            for ($i = 0; $i < $contador; $i++){
                echo $options[$i];
            }
            echo "</select>";
            echo "<br><br>";
            echo "<input type='text' name='RaçaAnimal' placeholder='Digite a raça do animal'>";
            echo "<br><br>";
            echo "<input type='submit'>";
        echo "</form>";
        $banco->GetConexão()->close();
    ?>
    <br>
    <a href="TabelaDeRaças.php">Tabela de raça de animais</a>
    <br>
    <br>
    <a href="../PáginaPrincipal.html">Página Principal</a>
  </body>
</html>