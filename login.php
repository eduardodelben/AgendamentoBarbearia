<?php
require 'conexao.php'; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o e-mail e a senha enviados pelo formulário
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Previne SQL Injection usando prepared statements
    $stmt = $conn->prepare("SELECT * FROM barbeiros WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Recupera o barbeiro encontrado
        $row = $result->fetch_assoc();

        // Verifica se a senha inserida corresponde à senha armazenada no banco de dados
        if ($senha === $row['senha']) {
            // Login bem-sucedido
            session_start();  // Inicia a sessão
            $_SESSION['email'] = $row['email']; // Armazena o e-mail do barbeiro na sessão
            header("Location: painel_barbeiro.php"); // Redireciona para o painel do barbeiro
            exit;
        } else {
            // Senha incorreta
            $erro = "Senha incorreta. Tente novamente.";
        }
    } else {
        // E-mail não encontrado
        $erro = "E-mail não encontrado. Verifique seu e-mail.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barbearia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-container button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .back-button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Caixa de login -->
    <div class="login-container">
        <h2>Login - Barbearia</h2>

        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Digite seu e-mail" required><br>
            <input type="password" name="senha" placeholder="Digite sua senha" required><br>
            <button type="submit">Entrar</button>
        </form>

        <?php if (isset($erro)): ?>
            <p class="error-message"><?php echo $erro; ?></p>
        <?php endif; ?>

        <!-- Botão de Voltar -->
        <form action="index.html">
            <button type="submit" class="back-button">Voltar para a Página Inicial</button>
        </form>
    </div>

    <!-- Rodapé -->
    <div class="footer">
        <p>&copy; 2024 Barbearia. Todos os direitos reservados.</p>
    </div>

</body>
</html>
