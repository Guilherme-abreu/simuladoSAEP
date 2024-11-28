<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

// Verifica se o formulário foi enviado para registrar o pedido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comprador_id = $_POST['comprador_id'];
    $sabor_pizza = $_POST['sabor_pizza'];
    $quantidade_pizza = $_POST['quantidade_pizza'];
    $observacao = $_POST['observacao'];
    
    // Insere o pedido no banco de dados
    $sql = "INSERT INTO pedidos (comprador_id, sabor_pizza, quantidade_pizza, observacao)
            VALUES (:comprador_id, :sabor_pizza, :quantidade_pizza, :observacao)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':comprador_id', $comprador_id);
    $stmt->bindParam(':sabor_pizza', $sabor_pizza);
    $stmt->bindParam(':quantidade_pizza', $quantidade_pizza);
    $stmt->bindParam(':observacao', $observacao);

    $stmt->execute();

    // Redireciona para a página de visualização de pedidos
    header('Location: pedidos.php');
    exit;
}

// Consulta todos os clientes cadastrados
$sql = "SELECT * FROM comprador";
$stmt = $conn->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedido - Padaria</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Função para preencher os campos de telefone e endereço automaticamente ao selecionar o cliente
        function preencherDadosCliente() {
            var compradorId = document.getElementById("comprador_id").value;
            var telefone = document.getElementById("telefone");
            var endereco = document.getElementById("endereco");

            <?php foreach ($comprador as $comprador): ?>
                if (compradorId == <?php echo $comprador['id']; ?>) {
                    telefone.value = "<?php echo $comprador['telefone_comprador']; ?>";
                    endereco.value = "<?php echo $comprador['endereco_comprador']; ?>";
                }
            <?php endforeach; ?>
        }
    </script>
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Vendas</a>
        <a href="pedidos.php">Visualizar Vendas</a>
        <a href="cadastro.php">Cadastrar Comprador</a>
    </nav>

    <h1>Registrar Pedido</h1>
    <form action="index.php" method="POST">
        <label for="comprador_id">Selecione o Comprador:</label>
        <select id="comprador_id" name="comprador_id" onchange="preencherDadosCliente()" required>
            <option value="">Escolha o Comprador</option>
            <?php foreach ($comprador as $comprador): ?>
                <option value="<?php echo $comprador['id']; ?>"><?php echo $comprador['nome_comprador']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" disabled><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" disabled><br>

        <label for="sabor_pizza">Sabor da Pizza:</label>
        <input type="text" id="sabor_pizza" name="sabor_pizza" required><br>

        <label for="quantidade_pizza">Quantidade:</label>
        <input type="number" id="quantidade_pizza" name="quantidade_pizza" required><br>

        <label for="observacao">Observação:</label>
        <input type="text" id="observacao" name="observacao"><br>

        <button type="submit">Registrar Pedido</button>
    </form>
</body>
</html>
