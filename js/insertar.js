$(document).ready(function() {
    $('#nuevoProductoForm').submit(function(e) {
      e.preventDefault(); // Evita el envío normal del formulario
  
      $.ajax({
        type: "POST",
        url: "controller/insertar.php",
        data: $(this).serialize(), // Serializa los datos del formulario
        dataType: "json", // Esperamos un JSON como respuesta
        success: function(response) {
          if (response.status === 'success') {
            alert(response.message); 
            window.location.href = "dashboard.php"; 
          } else {
            alert(response.message); 
          }
        },
        error: function() {
          alert("Error al enviar la solicitud.");
        }
      });
    });
  });
  