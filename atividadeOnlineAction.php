<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultado da Promoção</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #ecf0f1;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #2C3E50;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    .result-container {
      max-width: 600px;
      margin: 30px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
    }
    .result-container h2 {
      color: #2C3E50;
    }
    .result-container p {
      font-size: 1.1em;
      color: #333;
    }
    .discount {
      color: red;
      font-weight: bold;
    }
    .total {
      color: green;
      font-weight: bold;
    }
    .back-btn {
      display: inline-block;
      margin-top: 20px;
      background-color: #2C3E50;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
    }
    .back-btn:hover {
      background-color: #1a252f;
    }
  </style>
</head>
<body>
  <header>
    <h1>Resultado da Promoção</h1>
  </header>
  <div class="result-container">
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $nome = isset($_POST['txtNome']) ? trim($_POST['txtNome']) : "";
          
          // Converte vírgula para ponto e transforma o valor em float
          $valorCompraInput = isset($_POST['txtValorCompra']) ? trim($_POST['txtValorCompra']) : "";
          $valorCompraInput = str_replace(',', '.', $valorCompraInput);
          $valorCompra = floatval($valorCompraInput);
          
          $formaPagamento = isset($_POST['cmbPag']) ? $_POST['cmbPag'] : "";
          
          if ($nome == "" || $valorCompra <= 0 || $formaPagamento == "") {
              echo "<p>Dados inválidos. Por favor, preencha corretamente o formulário.</p>";
          } else {
              // Define o percentual de desconto com base na forma de pagamento
              $descontoPercent = 0;
              if ($formaPagamento == "deposito") {
                  $descontoPercent = 10;
              } elseif ($formaPagamento == "boleto") {
                  $descontoPercent = 8;
              }
              
              $valorDesconto = ($valorCompra * $descontoPercent) / 100;
              $valorFinal = $valorCompra - $valorDesconto;
              
              echo "<h2>Olá, " . htmlspecialchars($nome) . "!</h2>";
              echo "<p>Valor original da compra: R$ " . number_format($valorCompra, 2, ',', '.') . "</p>";
              echo "<p>Forma de pagamento selecionada: " . ucfirst($formaPagamento) . "</p>";
              echo "<p>Desconto aplicado: <span class='discount'>" . $descontoPercent . "%</span></p>";
              echo "<p>Valor do desconto: <span class='discount'>R$ " . number_format($valorDesconto, 2, ',', '.') . "</span></p>";
              echo "<p><strong>Valor final a ser pago: <span class='total'>R$ " . number_format($valorFinal, 2, ',', '.') . "</span></strong></p>";
          }
      } else {
          echo "<p>Por favor, envie os dados através do formulário.</p>";
      }
    ?>
    <a class="back-btn" href="index.html">Voltar</a>
  </div>
</body>
</html>
