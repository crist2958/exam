<?php
session_start();
error_log(print_r($_GET, true)); // información de errores al log
if (!isset($_SESSION['login'])) {
    header("location: index.php");
    exit();
}

include '../conexion.php';
$con = conectaDB();

if (isset($_POST["idPro"])) {
    $idPro = mysqli_real_escape_string($con, $_POST["idPro"]);

    $sql = "DELETE FROM tb_productos WHERE idPro = '$idPro'";
    
    if (mysqli_query($con, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Producto eliminado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el producto: ' . mysqli_error($con)]);
    }

    mysqli_close($con);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
}
?>
