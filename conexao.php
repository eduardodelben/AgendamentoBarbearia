<?php
// Configurações de conexão
$servername = "localhost";  
$username = "root";       
$password = "";             
$dbname = "barbearia";    

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>