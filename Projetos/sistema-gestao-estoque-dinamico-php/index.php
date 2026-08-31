<?php
// Iniciar uma sessão para manter os dados salvos sem banco de dados)
session_start();

// Se o estoque não existir na sessão, inicia um array vazio
if (!isset($_SESSION['estoque'])) {
    $_SESSION['estoque'] = [];
}

// Variáveis de controle de abas e mensagens do sistema
$abas = 'cadastro';
$mensagemErro = '';
$mensagemSucesso = '';

// Formulário de Cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-cadastrar'])) {
    $abas = 'cadastro';

    $produto = trim($_POST['produto'] ?? '');
    $quantidade = $_POST['quantidade'] ?? '';
    $preco = $_POST['preco'] ?? '';

    // Verificações de erros de preenchimento das informações
    if (empty($produto)) {
        $mensagemErro = "❌ O nome do produto é obrigatório.";
    } elseif ($quantidade === '' || !is_numeric($quantidade) || intval($quantidade) < 0) {
        $mensagemErro = "❌ A quantidade deve ser um número inteiro maior ou igual a zero.";
    } elseif ($preco === '' || !is_numeric($preco) || floatval($preco) <= 0) {
        $mensagemErro = "❌ O preço deve ser um número maior que zero.";
    } else {
        // Valida se o produto já existe (ignora maiúsculas/minúsculas)
        $existe = false;
        foreach ($_SESSION['estoque'] as $item) {
            if (strcasecmp($item['produto'], $produto) === 0) {
                $existe = true;
                break;
            }
        }

        if ($existe) {
            $mensagemErro = "❌ Este produto já está cadastrado.";
        } else {
            // Grava o item no array da sessão se passar nas validações
            $_SESSION['estoque'][] = [
                'produto' => $produto,
                'quantidade' => intval($quantidade),
                'preco' => floatval($preco)
            ];
            $mensagemSucesso = "✅ Produto '{$produto}' cadastrado com sucesso!";
        }
    }
}

// Movimentação de Estoque e Preços
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-movimentar'])) {
    $abas = 'movimentacao';

    $indexProduto = $_POST['produto_index'] ?? '';
    $tipoMovimentacao = $_POST['tipo_movimentacao'] ?? '';
    $qtdMovimentar = $_POST['qtd_movimentar'] ?? 0;
    $novoPreco = $_POST['novo_preco'] ?? '';

    if ($indexProduto === '' || !isset($_SESSION['estoque'][$indexProduto])) {
        $mensagemErro = "❌ Selecione um produto válido da lista.";
    } else {
        // Usa referência (&) para alterar o produto original dentro da sessão
        $prod =& $_SESSION['estoque'][$indexProduto];

        // Processa entrada ou saída se a quantidade for preenchida
        if ($qtdMovimentar !== '' && is_numeric($qtdMovimentar) && intval($qtdMovimentar) > 0) {
            $qtdMovimentar = intval($qtdMovimentar);
            if ($tipoMovimentacao === 'entrada') {
                $prod['quantidade'] += $qtdMovimentar;
                $mensagemSucesso = "✅ Entrada de estoque realizada com sucesso!";
            } elseif ($tipoMovimentacao === 'saida') {
                if ($prod['quantidade'] >= $qtdMovimentar) {
                    $prod['quantidade'] -= $qtdMovimentar;
                    $mensagemSucesso = "✅ Saída de estoque realizada com sucesso!";
                } else {
                    $mensagemErro = "❌ Saldo insuficiente! Estoque atual desse produto: {$prod['quantidade']}.";
                }
            }
        }

        // Processa alteração de preço se for preenchida
        if ($novoPreco !== '') {
            if (is_numeric($novoPreco) && floatval($novoPreco) > 0) {
                $prod['preco'] = floatval($novoPreco);
                $mensagemSucesso .= ($mensagemSucesso ? " e " : "✅ ") . "Preço atualizado para R$ " . number_format($prod['preco'], 2, ',', '.');
            } else {
                $mensagemErro .= " ❌ O novo preço deve ser um valor numérico positivo.";
            }
        }

        if (empty($mensagemSucesso) && empty($mensagemErro)) {
            $mensagemErro = "❌ Preencha a quantidade de movimentação ou informe um novo preço.";
        }
    }
}

// Captura a aba clicada no menu
if (isset($_GET['aba'])) {
    $abas = $_GET['aba'];
}

// Monta Tabela de estoque
function gerarTabelaEstoque(array $itens)
{
    if (empty($itens)) {
        return "<tr><td colspan='3' class='vazio'>Nenhum produto cadastrado ainda.</td></tr>";
    }
    $html = "";
    foreach ($itens as $item) {
        $precoFormatado = 'R$ ' . number_format($item['preco'], 2, ',', '.');
        $html .= "<tr>
                    <td>{$item['produto']}</td>
                    <td>{$item['quantidade']}</td>
                    <td>{$precoFormatado}</td>
                  </tr>";
    }
    return $html;
}

// Alertas críticos
function gerarAlertasReposicao(array $itens, int $limiteMinimo)
{
    if (empty($itens)) {
        return "<div class='vazio'>O estoque está totalmente vazio.</div>";
    }
    $html = "";
    $contadorAlertas = 0;

    for ($i = 0; $i < count($itens); $i++) {
        if ($itens[$i]['quantidade'] <= $limiteMinimo) {
            $html .= "<div style='padding: 12px; background-color: #fff3cd; color: #856404; border-left: 5px solid #ffc107; margin-bottom: 10px; border-radius: 20px;'> ⚠️ O produto <strong>{$itens[$i]['produto']}</strong> precisa de reposição urgente! (Apenas {$itens[$i]['quantidade']} unidades disponíveis)
                      </div>";
            $contadorAlertas++;
        }
    }

    if ($contadorAlertas === 0) {
        return "<div style='padding: 12px; background-color: #d4edda; color: #155724; border-left: 5px solid #28a745; border-radius: 20px;'>✅ Todos os itens cadastrados estão com estoque seguro.</div>";
    }

    return $html;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Estoque Dinâmico em PHP</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            background-color: bisque;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h2,
        h3 {
            color: #2c3e50;
            text-align: center;
        }

        .menu {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background: #fff;
            padding: 10px;
            border-radius: 20px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }

        .btn-aba {
            padding: 10px 15px;
            text-decoration: none;
            color: #495057;
            font-weight: bold;
            border-radius: 20px;
        }

        .btn-aba:hover {
            background: cadetblue;
        }

        .btn-aba.ativo {
            background: #007bff;
            color: white;
        }

        .msg-erro {
            padding: 12px;
            background: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .msg-sucesso {
            padding: 12px;
            background: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .bloco-visivel {
            display: block;
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }

        .bloco-oculto {
            display: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 20px;
            text-align: center;
        }

        .btn-submit {
            background: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 20px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-radius: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: black;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: antiquewhite;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        .vazio {
            color: #6c757d;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Sistema de Gestão de Estoque</h2>
        <!-- Menu -->
        <div class="menu">
            <a href="index.php?aba=cadastro" class="btn-aba <?php echo $abas === 'cadastro' ? 'ativo' : ''; ?>">➕
                Cadastrar Produto</a>
            <a href="index.php?aba=movimentacao"
                class="btn-aba <?php echo $abas === 'movimentacao' ? 'ativo' : ''; ?>">🔄 Movimentar/Preço</a>
            <a href="index.php?aba=listar" class="btn-aba <?php echo $abas === 'listar' ? 'ativo' : ''; ?>">📊
                Listar Estoque</a>
            <a href="index.php?aba=alertas" class="btn-aba <?php echo $abas === 'alertas' ? 'ativo' : ''; ?>">🚨
                Alertas críticos</a>
        </div>

        <!-- Mensagens -->
        <?php if (!empty($mensagemErro)): ?>
            <div class="msg-erro"><?php echo $mensagemErro; ?></div>
        <?php endif; ?>

        <?php if (!empty($mensagemSucesso)): ?>
            <div class="msg-sucesso"><?php echo $mensagemSucesso; ?></div>
        <?php endif; ?>

        <!-- Cadastro -->
        <div class="<?php echo $abas === 'cadastro' ? 'bloco-visivel' : 'bloco-oculto'; ?>">
            <h3>Novo Cadastro de Produto</h3>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label>Nome do Produto:</label>
                    <input type="text" name="produto" placeholder="Ex: Camiseta Nike">
                </div>
                <div class="form-group">
                    <label>Quantidade Inicial:</label>
                    <input type="number" name="quantidade" placeholder="Ex: 10" min="0">
                </div>
                <div class="form-group">
                    <label>Preço Unitário (R$):</label>
                    <input type="number" name="preco" step="0.01" placeholder="Ex: 89.90" min="0.01">
                </div>
                <button type="submit" name="btn-cadastrar" class="btn-submit">Salvar Produto</button>
            </form>
        </div>

        <!-- Movimentação -->
        <div class="<?php echo $abas === 'movimentacao' ? 'bloco-visivel' : 'bloco-oculto'; ?>">
            <h3>Movimentar Quantidade ou Alterar Preço</h3>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label>Selecione o Produto:</label>
                    <select name="produto_index">
                        <option value="">-- Escolha um Produto --</option>
                        <?php foreach ($_SESSION['estoque'] as $index => $item): ?>
                            <option value="<?php echo $index; ?>">
                                <?php echo $item['produto'] . " (Atual: " . $item['quantidade'] . " un | R$ " . number_format($item['preco'], 2, ',', '.') . ")"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Operação de Quantidade:</label>
                    <select name="tipo_movimentacao">
                        <option value="entrada">Entrada (+) no estoque</option>
                        <option value="saida">Saída (-) do estoque</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantidade a Alterar (Deixe vazio se for alterar apenas o preço):</label>
                    <input type="number" name="qtd_movimentar" min="1" placeholder="Ex: 5">
                </div>
                <div class="form-group">
                    <label>Novo Preço Unitário (Opcional - Deixe vazio para manter o atual):</label>
                    <input type="number" name="novo_preco" step="0.01" min="0.01" placeholder="Ex: 95.00">
                </div>
                <button type="submit" name="btn-movimentar" class="btn-submit" style="background: #007bff;">Processar
                    Atualização</button>
            </form>
        </div>

        <!-- Listagem -->
        <div class="<?php echo $abas === 'listar' ? 'bloco-visivel' : 'bloco-oculto'; ?>">
            <h3>Estoque Atualizado</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo gerarTabelaEstoque($_SESSION['estoque']); ?>
                </tbody>
            </table>
        </div>

        <!-- Alertas -->
        <div class="<?php echo $abas === 'alertas' ? 'bloco-visivel' : 'bloco-oculto'; ?>">
            <h3>Produtos com Baixo Estoque (Limite: 5 Unidades)</h3>
            <?php echo gerarAlertasReposicao($_SESSION['estoque'], 5); ?>
        </div>

    </div>

</body>

</html>