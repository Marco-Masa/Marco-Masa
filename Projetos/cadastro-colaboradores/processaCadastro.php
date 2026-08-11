<?php

// Recebe as informações e grava em variáveis

// Converte a informação do Nome para que todas as primeiras letras em maiúscula
$nome = mb_convert_case($_POST["nome"], MB_CASE_TITLE, "UTF-8");

$idade = $_POST["idade"];

// Converte a informação da Profissão para que todas as primeiras letras em maiúscula
$profissao = mb_convert_case($_POST["profissao"], MB_CASE_TITLE, "UTF-8");

$salario = number_format($_POST["salario"], 2, ',', '.');

// Converte a informação da Experiência Profissional para que a primeira letra da string fique em maiúscula.
$experiencia = ucfirst($_POST["experiencia"]);

// Construção da tela de retorno da Confirmaçao de Recebimento das Informações

// Formatação dos estilos da pagina
echo "<style>";

echo "body {";
echo "background-color: gray;";
echo "font-weight: bold;";
echo "padding: 20px;";
echo "}";

echo "div {";
echo "display: flex;";
echo "justify-content: center;";
echo "}";

echo "fieldset {";
echo "background-color: bisque;";
echo "border: 4px dashed chocolate;";
echo "border-radius: 20px;";
echo "box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);";
echo "padding: 20px;";
echo "width: 70%;";
echo "box-sizing: border-box;";
echo "overflow-wrap: break-word;";
echo "}";

echo "legend {";
echo "font-size: 1.9rem;";
echo "padding-right: 10px;";
echo "padding-left: 10px;";
echo "color: black;";
echo "}";

echo "p {";
echo "font-size: 1.4rem;";
echo "margin-top: 10px;";
echo "margin-bottom: 10px;";
echo "}";

echo "span {";
echo "font-weight: normal;";
echo "padding-left: 15px;";
echo "}";

echo "a {";
echo "text-decoration: none;";
echo "}";

echo "hr {";
echo "margin: 20px;";
echo "}";

echo ".resposta {";
echo "display: flex;";
echo "justify-content: center;";
echo "margin-top: 20px;";
echo "}";

echo ".agradecimento {";
echo "font-size: 1.6rem;";
echo "text-align: center;";
echo "margin-top: 20px;";
echo "margin-bottom: 40px;";
echo "}";

echo ".botao {";
echo "width: 50%;";
echo "border-radius: 15px;";
echo "background-color: chocolate;";
echo "color: white;";
echo "box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);";
echo "padding: 10px;";
echo "cursor: pointer;";
echo "font-size: 1.2rem;";
echo "}";

echo "</style>";

// Criação e apresentação das informações da resposta
echo "<div class='resposta'>";
echo "<div>";
echo "<fieldset>";
echo "<legend>Recebemos suas informações</legend>";
echo "<p>Nome Completo:<br><span>$nome</span></p>";
echo "<p>Idade:<br><span>$idade anos</span></p>";
echo "<p>Profissão:<br><span>$profissao</span></p>";
echo "<p>Salário Pretendido:<br><span>R$ $salario</span></p>";
echo "<p>Experiências Anteriores:<br><span>$experiencia</span></p>";
echo "<hr>";
echo "<p>Olá, $nome!<br><br>Confirmamos o recebimento dos seus dados.<br><br>Registramos que você atua como $profissao e possui $experiencia de bagagem na área.</p>";
echo "<p class='agradecimento'>Agradecemos pelo envio!</p>";
echo "<a href='./cadastro.html'>";
echo "<div>";
echo "<input class='botao' type='button' value='Voltar' title='Clique para retornar para a tela de cadastro de Colaboradores.'>";
echo "</div>";
echo "</a>";
echo "</fieldset>";
echo "<div>";
echo "<div>";
