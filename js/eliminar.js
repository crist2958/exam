$(document).ready(function() {
    $('.btnEliminar').click(function(e) {
        e.preventDefault(); 

        var idPro = $(this).data('id'); //asignamos el id del producto
        var nombre = $(this).data('nombre');

        console.log("Producto a eliminar: " + idPro); // se dice por consola el ID del producto

        if (confirm('¿Estás seguro de que deseas eliminar el producto ' + nombre + '?')) {
            $.ajax({
                type: "POST",
                url: "controller/eliminar.php",
                data: { idPro: idPro }, // Envía el ID del producto
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message); 
                        location.reload(); 
                    } else {
                        alert("Error: " + response.message); 
                        console.log(response); // Verifica el contenido completo de la respuesta
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error en la solicitud: " + error); // Muestra el error
                    console.log(xhr.responseText);
                }
            });
        }
    });
});
