<?php
require 'conexao.php'; // Conexão com o banco de dados

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$barbeiro_email = $_SESSION['email']; // E-mail do barbeiro logado

// Consulta todos os agendamentos
$sql = "SELECT * FROM agendamentos"; // Todos os agendamentos serão exibidos

// Prepara e executa a consulta
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Barbeiro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1000px;
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Todos os Agendamentos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome Cliente</th>
            <th>Serviço</th>
            <th>Data</th>
            <th>Hora</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome_cliente']; ?></td>
            <td><?php echo $row['servico']; ?></td>
            <td><?php echo $row['data']; ?></td>
            <td><?php echo $row['hora']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="logout.php" class="btn">Sair</a>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
