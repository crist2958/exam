<?php
session_start();
error_log(print_r($_GET, true)); // información de errores al log
if (!isset($_SESSION['login'])) {
    header("location: index.php");
    exit();
}

include('../conexion.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idpro']; 
    $nuevoNombre = $_POST['nombre'];
    $nuevoPrecio = $_POST['precio'];
    $nuevaExistencia = $_POST['existencia'];

    $con = conectaDB(); // Conexión a la base de datos

    // Actualizar la base de datos
    $sql = "UPDATE tb_productos SET Nombre=?, Precio=?, Ext=? WHERE idPro=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sdsi", $nuevoNombre, $nuevoPrecio, $nuevaExistencia, $id);

    if ($stmt->execute()) {
        echo "Producto actualizado exitosamente."; // Mensaje de éxito
    } else {
        echo "Error al actualizar el producto: " . $con->error; // Mensaje de error
    }

    $stmt->close();
    $con->close();
} else {
    echo "Método no permitido.";
}
?>
