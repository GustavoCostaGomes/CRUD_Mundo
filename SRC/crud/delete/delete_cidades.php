<?php
include '../../database/db.php';

if (isset($_GET['id_cidade'])) {   
    $id = $_GET['id_cidade'];

    $sql = "DELETE FROM cidades WHERE id_cidade = $id";

    if ($conn->query($sql) === TRUE) {
        //header("Location: ?message=" . urldecode("Registro excluído com sucesso"));
        exit();
    } else {
        //header("Location: ?message=" . urldecode("Erro ao excluir registro"));
        exit();
    }

    $conn->close();
    //header("Location: ");
} 
?>