<?php
session_start();
error_log(print_r($_GET, true)); // información de errores al log
if (!isset($_SESSION['login'])) {
    header("location: index.php");
    exit();
}

include '../conexion.php';  // Incluye el archivo de conexión

// Establece la conexión a la base de datos
$con = conectaDB(); // Llama a la función que devuelve la conexión

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $existencia = $_POST["existencia"];

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES ('$nombre', '$precio', '$existencia')";
    
    if (mysqli_query($con, $sql)) {
        // Si la inserción es exitosa, devuelve una respuesta JSON
        echo json_encode(['status' => 'success', 'message' => 'Producto registrado correctamente.']);
    } else {
        // Si hay un error, devuelve una respuesta de error en formato JSON
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el producto: ' . mysqli_error($con)]);
    }

    // Cierra la conexión
    mysqli_close($con);
} else {
    // En caso de que no sea una solicitud POST, devolvemos un mensaje de error
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
}
?>
