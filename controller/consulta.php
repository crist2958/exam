<?php
session_start();
error_log(print_r($_GET, true)); // información de errores al log
if (!isset($_SESSION['login'])) {
    header("location: index.php");
    exit();
}

include('../conexion.php');
$con = conectaDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idPro = $_GET['id']; // ID del producto

    // Consulta para obtener la información del producto
    $sql = "SELECT Nombre, Precio, Ext FROM tb_productos WHERE idPro = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $idPro);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'producto' => $producto]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
