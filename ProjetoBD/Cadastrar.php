<?php

    $nome = $_GET["nome"];
    $celular = $_GET["celular"];
    $email = $_GET["email"];
    $cpf = $_GET["cpf"];
    $SerasaScore = $_GET["Sscore"];
    $salario = $_GET["salario"];

    include "Banco.php";


	$NumCartao = (string) rand(1000, 9999) . " " . (string) rand(1000, 9999) . " " . (string) rand(1000, 9999) . " " . (string) rand(1000, 9999);
	$cvv = (string) rand(100, 999);
	$dataInicio = date("m/y");
	$mes = date("m");
	$data = (string) rand($mes,12) . "/" . (string) rand(22,35);
	$limite = $salario * 1.6;
	$limiteVermelho = $limite * 1.15;
	
	$cartao = "CARD NUMBER: $NumCartao\nSECURITY CODE: $cvv\nMEMBER SINCE: $dataInicio\nVALID THRU: $data\nLimite: R$$limite";
		
	require_once('phpqrcode/qrlib.php');

	$QrCode = "Cartão_de_$nome.png";

	QRcode::png($cartao, $QrCode);
	

    class Cartão{

        function __construct(){
            $this->banco = new Banco();
        }

        public function CadastrarCliente($nome, $celular, $email, $cpf, $SerasaScore, $salario)
        {
            $stmt = $this->banco->getConexão()->prepare("insert into Cliente values(default,?,?,?,?,?,?);");
            $stmt->bind_param("ssssid", $nome, $celular, $email, $cpf, $SerasaScore, $salario);
            return $stmt->execute();
        }

		public function CadastrarCartao($cpf, $NumCartao, $cvv, $dataInicio, $data, $limite, $limiteVermelho)
		{
			$sql = "select idCliente from Cliente where cpf = ?;";
			$stmt = $this->banco->getConexão()->prepare($sql);
			$stmt->bind_param("s", $cpf);
			$stmt->execute();
			$resultado = $stmt->get_result();
			if ($linha = $resultado->fetch_object()){
				$idCliente = $linha->idCliente;
			}

			$stmt = $this->banco->getConexão()->prepare("insert into CartaoCliente values(default,?,?,?,?,?,?,?)");
			$stmt->bind_param("isissdd", $idCliente, $NumCartao, $cvv, $dataInicio, $data, $limite, $limiteVermelho);
			return $stmt->execute();
		}

    }


	$cartao = new Cartão();


	$cartao->CadastrarCliente($nome, $celular, $email, $cpf, $SerasaScore, $salario);

	$cartao->CadastrarCartao($cpf, $NumCartao, $cvv, $dataInicio, $data, $limite, $limiteVermelho);




?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./Cartão.css">
	<title>Banco 2°FID</title>
</head>

<body>

	<h1 style="text-align: center;">Parabéns! Seu cadastro foi realizado e seu cartão chegará em poucos dias</h1>
	<center>
		<?php	
			echo "<img src='{$QrCode}' width=200px>";
		?>
		<p>QrCode com as informações do seu cartão</p>
	</center>
	<section class="credit-card"> 
		<div class="card">
			<div class="face front absolute">
				<img src="./Fotos/chip.svg" alt="Chip" id="chip" class="absolute"></img>
				<img src="./Fotos/signal.svg" alt="Signal" id="signal" class="absolute"></img>
				<img src="./Fotos/logo.svg" alt="Logo" id="logo" class="absolute"></img>
				<p id="owner" class="absolute"><?php echo $nome?></p>
			</div>
			<div class="face back absolute">
				<div id="graybar" class="absolute"></div>
				<div id="card-info" class="absolute">
					<p id="card-number"><?php echo $NumCartao?></p>
					<div class="flex">
						<p class="flex informations">
							<span class="label">MEMBER SINCE</span>
							<span><?php echo $dataInicio?></span>
						</p>
						<p class="flex informations">
							<span class="label">VALID THRU</span>
							<span><?php echo $data?></span>
						</p>
						<p class="flex informations">
							<span class="label">SECURITY CODE</span>
							<span><?php echo $cvv?></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>