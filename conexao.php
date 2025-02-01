<?php
// Configurações de conexão
$servername = "localhost";  // Ou o endereço do seu servidor MySQL
$username = "root";         // Usuário do MySQL
$password = "";             // Senha do MySQL (geralmente vazia no XAMPP)
$dbname = "barbearia";      // Nome do banco de dados

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>