<?php
	session_start();
	if (!isset($_SESSION['login']))
		header("location: index.php");	
?>
<html>
<head>
	<title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
	<link href="css/cmce-styles.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
	<div class="container-fluid">
    	<a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?> [<?php echo $_SESSION['nomComplet']; ?>] </a> 
		<a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
  </div>
</nav>
<center>
	<br><br><br><br>
		

<form action="dashboard.php" method="GET">
    <div class="formpanel" id="f1">
        <b>Buscar producto por precio mayor a:</b> 
        <input type="number" name="pre" size="4" required>
        <input class="btn btn-primary" type="submit" value="Buscar">
		<button type="button" class="btn btn-primary" title="Refresca la pagina"><a href="dashboard.php" tittle="refresca la pagina"> <img src='icons8-actualizar.svg' width='24' height='24'></a></button>
		
    </div>
</form>
	
	<br><br>
		<hr>
	<br><br>

	<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  		Nuevo Producto
	</button>

	<br><br>
<?php

	include('conexion.php');
	$con = conectaDB();
	if(isset($_GET['pre'])==true)		
		$sql ="select idPro,Nombre,Precio from tb_productos where Precio > ".$_GET['pre'];
	else
		$sql ="select idPro,Nombre,Precio from tb_productos";
		
	echo "<table class='table' style='width:570;'>";
	echo "<thead class='table-dark'>";
	echo "<th>Nombre</th>";
	echo "<th>Precio</th>";
	echo "<th></th>";
	echo "<th></th>";
	echo "</thead>";
	echo "<tbody>";
	
	$resultado = mysqli_query($con,$sql);  
	while($fila = mysqli_fetch_row($resultado)){
 	
		echo "<tr>";
			echo "<td>".$fila[1]."</td>";
			echo "<td>".$fila[2]."</td>";
			echo "<td><a href='#'  class='btnEliminar' data-id='".$fila[0]."' data-nombre='".$fila[1]."'><img src='iconoeliminar.png'  width='20' height='20'></a></td>";
			echo "<td><a href='#' class='btnEditar' data-id='".$fila[0]."' data-bs-toggle='modal' data-bs-target='#modalEditar'><img src='icons8-editar-64.png' width='20' height='20'></a></td>";



		echo "</tr>";
	
	}
	
	echo "</tbody> </table>";
?>
<br><br>
	<!-- Modal Ventada de Nuevo Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<!-- formulario -->
		<form id="nuevoProductoForm" method="POST">
			<div class="mb-3">
				<label for="nombreProducto" class="form-label">Nombre del Producto</label>
				<input type="text" class="form-control" id="nombre" name="nombre" required>
			</div>
			<div class="mb-3">
				<label for="precioProducto" class="form-label">Precio</label>
				<input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
			</div>
			<div class="mb-3">
				<label for="existenciaProducto" class="form-label">Existencia</label>
				<input type="number" class="form-control" id="existencia" name="existencia" step="1" min="0" required>
			</div>


		</form>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
		
       <button type="submit" form="nuevoProductoForm" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para editar producto -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarProducto">
          <input type="hidden" id="idPro" name="idpro"> <!-- Campo oculto para el ID del producto -->
          <div class="mb-3">
            <label for="editarNombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="editarNombre" name="nombre">
          </div>
          <div class="mb-3">
            <label for="editarPrecio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="editarPrecio" name="precio" step="0.01" min="0" required>
          </div>
          <div class="mb-3">
            <label for="editarExistencia" class="form-label">Existencia</label>
            <input type="number" class="form-control" id="editarExistencia" name="existencia" step="1" min="0" required>
          </div>
          <button type="button" class="btn btn-primary" id="btnActualizarProducto">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>




</center>

    <!-- Footer -->
    <footer class="footer bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white" ><b> UC: Desarrollo de aplicaciones web y móviles   [ Dr. Christian Mauricio Castillo Estrada ] </b></p>
      </div>
    </footer>

	<script src="js/actualizar.js"></script>
	<script src="js/login.js"></script> 
	<script src="js/insertar.js"></script>
	<script src="js/eliminar.js"></script>


</body>
</html>