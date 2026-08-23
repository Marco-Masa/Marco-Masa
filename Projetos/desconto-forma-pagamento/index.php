<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calulo de Descontos - Madeira e Cia Ltda.</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        h2 {
            margin: 0;
        }

        img {
            max-height: 90px;
        }

        select, option {
            text-align: center;
        }

        .header {
            max-width: 600px;
        }

        .container {
            max-width: 500px;
        }
    </style>
</head>
<header class="w3-container w3-teal w3-padding-16 w3-center w3-card-4">
    <div class="w3-content header">
        <img src="madeiraecia.png" alt="Logotipo Madeira e Cia." class="w3-image">
        <h1 class="w3-xlarge w3-text-white w3-wide">Aniversário Madeira e Cia.</h1>
        <h2 class="w3-large w3-text-light-grey">Confira o seu desconto!!!</h2>
    </div>
</header>

<body class="w3-light-grey">
    <main class="w3-container w3-padding-32">
        <div class="w3-content w3-card-4 w3-white w3-round w3-round-xxlarge container">
            <div class="w3-container w3-teal w3-round-top">
                <h3 class="w3-large w3-margin-top w3-margin-bottom w3-center">Cálculo de Desconto</h3>
            </div>
            <form method="POST" action="calculaDesconto.php" class="w3-container w3-padding-24">
                <p class="w3-margin-bottom">
                    <label class="w3-text-teal"><b><span class="w3-text-red">* </span>Nome do Cliente:</b></label>
                    <input type="text" name="txtNome" id="txtNome" placeholder="Ex: João da Silva" title="Informe o nome do cliente." required class="w3-input w3-border w3-round">
                </p>
                <p class="w3-margin-bottom">
                    <label class="w3-text-teal"><b><span class="w3-text-red">* </span>Valor da Compra (R$):</b></label>
                    <input type="number" name="txtValorCompra" id="txtValorCompra" placeholder="0.00" title="Informe o valor da compra." step="0.01" required class="w3-input w3-border w3-round">
                </p>
                <p class="w3-margin-bottom">
                    <label class="w3-text-teal"><b><span class="w3-text-red">* </span>Forma de Pagamento:</b></label>
                    <select name="cmbPag" id="cmbPag" title="Informe uma opção de pagamento." required class="w3-select w3-border w3-round">
                        <option value="" disabled selected hidden>Selecione uma opção</option>
                        <option value="deposito">Depósito</option>
                        <option value="boleto">Boleto</option>
                        <option value="cartaoCredito">Cartão de Crédito</option>
                    </select>
                </p>
                <p class="w3-margin-top-24">
                    <input type="submit" name="calculaDesconto" id="calculaDesconto" value="Calcular Desconto" class="w3-button w3-block w3-teal w3-hover-dark-grey w3-round w3-ripple w3-padding-large">
                </p>

            </form>
        </div>
    </main>
</body>

</html>
