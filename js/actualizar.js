// Evento para abrir el modal y cargar los datos del producto
$('.btnEditar').click(function() {
  var id = $(this).data('id'); 

  $.ajax({
      type: "GET",
      url: "controller/consulta.php", 
      data: { id: id }, 
      dataType: "json",
      success: function(data) {
          if (data.status === 'success') {
              // Llenar los campos con la información del producto
              $('#editarNombre').val(data.producto.Nombre);
              $('#editarPrecio').val(data.producto.Precio);
              $('#editarExistencia').val(data.producto.Ext); 
              $('#idPro').val(id); // Asignar el ID del producto
          } else {
              alert(data.message);
          }
      },
      error: function() {
          alert("Error al obtener los datos del producto.");
      }
  });
});

// actualizar el producto
$('#btnActualizarProducto').click(function() {
  var formData = $('#formEditarProducto').serialize(); // datos del formulario

  $.ajax({
      type: "POST",
      url: "controller/actualizar.php",
      data: formData, // Datos del formulario
      success: function(response) {
          alert(response); // Mostrar mensaje de exito o error
          $('#modalEditar').modal('hide'); // Cerrar el modal
          location.reload(); // Recargar la pagina 
      },
      error: function() {
          alert("Error al actualizar el producto.");
      }
  });
});
