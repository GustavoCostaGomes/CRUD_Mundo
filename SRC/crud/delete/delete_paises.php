<?php
include '../../database/db.php';

if (isset($_GET['id_pais'])) {   
    $id = $_GET['id_pais'];

    $sql = "DELETE FROM paises WHERE id_pais = $id";

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