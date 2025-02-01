<?php
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $servico = $_POST['servico'];

    // Verifica se o horário já está agendado
    $sqlVerifica = "SELECT * FROM agendamentos WHERE data = '$data' AND hora = '$hora'";
    $resultado = $conn->query($sqlVerifica);

    if ($resultado->num_rows > 0) {
        // Horário indisponível
        echo "<p>Este horário já está agendado. Por favor, escolha outro horário ou dia.</p>";
    } else {
        // Verifica se todos os horários do dia estão ocupados
        $sqlTotalDia = "SELECT COUNT(*) as total FROM agendamentos WHERE data = '$data'";
        $resultadoTotal = $conn->query($sqlTotalDia);
        $rowTotal = $resultadoTotal->fetch_assoc();

        if ($rowTotal['total'] >= 10) { // Defina aqui o limite diário de agendamentos
            echo "<p>Não há mais horários disponíveis para esta data.</p>";
        } else {
            // Insere o agendamento no banco de dados
            $sqlInserir = "INSERT INTO agendamentos (nome_cliente, email_cliente, data, hora, servico) 
                           VALUES ('$nome', '$email', '$data', '$hora', '$servico')";

            if ($conn->query($sqlInserir) === TRUE) {
                echo "<p>Agendamento realizado com sucesso!</p>";
            } else {
                echo "<p>Erro ao salvar o agendamento: " . $conn->error . "</p>";
            }
        }
    }
}

$conn->close();
?>