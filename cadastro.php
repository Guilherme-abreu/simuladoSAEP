<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome_comprador = $_POST['nome_comprador'];
    $telefone_comprador = $_POST['telefone_comprador'];
    $endereco_comprador = $_POST['endereco_comprador'];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO comprador (nome_comprador, telefone_comprador, endereco_comprador)
            VALUES (:nome_comprador, :telefone_comprador, :endereco_comprador)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome_comprador', $nome_comprador);
    $stmt->bindParam(':telefone_comprador', $telefone_comprador);
    $stmt->bindParam(':endereco_comprador', $endereco_comprador);

    $stmt->execute();

    // Redireciona para a página de pedidos
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente - Padaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Pedido</a>
        <a href="pedidos.php">Visualizar Pedidos</a>
        <a href="cadastro.php">Cadastrar Cliente</a>
    </nav>

    <h1>Cadastro de Cliente</h1>
    <form action="cadastro.php" method="POST">
        <label for="nome_comprador">Nome do Comprador:</label>
        <input type="text" id="nome_comprador" name="nome_comprador" required><br>

        <label for="telefone_comprador">Telefone:</label>
        <input type="text" id="telefone_comprador" name="telefone_comprador" required><br>

        <label for="endereco_comprador">Endereço:</label>
        <input type="text" id="endereco_comprador" name="endereco_comprador" required><br>

        <button type="submit">Cadastrar Comprador</button>
    </form>
</body>
</html>
