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

        p {
            text-align: justify;
        }

        img {
            max-height: 90px;
        }

        .header {
            max-width: 600px;
        }

        .container {
            max-width: 400px;
        }

        .footer {
            max-width: 1000px;
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
            <div class="w3-container w3-round-top w3-padding-32 w3-center">
                <h3>
                    <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Instância as variáveis
                        $nome = mb_convert_case($_POST["txtNome"], MB_CASE_TITLE, "UTF-8");
                        $valorCompra = $_POST["txtValorCompra"];
                        $formaPagamento = $_POST["cmbPag"];
                        $desconto = 0;
                        $mensagem = "Olá <b>$nome</b>,<br><br>Sua compra de <b>R$ " . number_format($valorCompra, 2, ',', '.') . "</b> foi realizada com ";
                        $mensagem_complemento = "";
                        $erro = "";

                        // Verifica o desconto conforme a opção de pagamento.
                        if ($formaPagamento == "cartaoCredito") {
                            // Cartão de crédito: sem desconto
                            $mensagem_complemento = '"Cartão de Crédito".<br><br>Não há desconto.';
                        } elseif ($formaPagamento == "boleto") {
                            // Boleto: 8%
                            $desconto = $valorCompra * 0.08;
                            $mensagem_complemento = '"Boleto".<br><br>Seu desconto é de <b>R$ ' . number_format($desconto, 2, ',', '.') . ".</b>";
                        } elseif ($formaPagamento == "deposito") {
                            // Depósito: 10%
                            $desconto = $valorCompra * 0.1;
                            $mensagem_complemento = '"Depósito".<br><br>Seu desconto é de <b>R$ ' . number_format($desconto, 2, ',', '.') . ".</b>";
                        } else {
                            $erro = "Forma de pagamento inválida!";
                        }

                        // Mensagem final
                        echo "<label>" . ((empty($erro)) ? "{$mensagem} {$mensagem_complemento}" : $erro) . "</label>";
                    }

                    ?>
                </h3>
            </div>
        </div>
    </main>
    <!-- COMENTÁRIO REFLEXIVO DE DESENVOLVIMENTO: -->
    <footer class="w3-container w3-teal w3-padding-16 w3-margin-top">
        <div class="w3-content w3-row footer">
            <div class="w3-col w3-half w3-padding">
                <p class="w3-small">
                    <b>Explicação Lógica da Interface:</b><br>Este arquivo constrói a porta de entrada dos dados do sistema.<br>A estrutura lógica garante que o servidor PHP só receba requisições sanitizadas e completas graças aos validadores HTML5 inseridos no formulário.<br>O design responsivo gerido pelas classes 'w3-input' e 'w3-select' garante consistência visual, permitindo que a coleta de dados funcione perfeitamente em qualquer tamanho de tela.
                </p>
            </div>
            <div class="w3-col w3-half w3-padding">
                <p class="w3-small">
                    <b>Comentário Reflexivo de Desenvolvimento:</b><br>O desenvolvimento lógico do sistema foca na experiência do usuário e integridade dos dados.<br>As tags de input utilizam atributos nativos como 'required' para validação de campo vazio, 'step="0.01"' para precisão decimal no valor flutuante da compra e uma tag 'select' com opções parametrizadas que correspondem exatamente às chaves condicionais que o interpretador PHP espera receber no arquivo de destino.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>