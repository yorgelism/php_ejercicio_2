<!DOCTYPE html>
<html>
<head>
	<title>Medicamentos</title>
	<style>
		 
		 body {
        font-family: Arial, sans-serif;
        background-color: #87ab8d;
      }
      
      h1 {
        color: #333333;
        text-align: center;
      }
      
      ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      
      li {
        margin: 10px;
      }
      
      a {
        display: block;
        padding: 10px;
        background-color: #05f72d;
        color: #101211;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
        align:left ;

      }
      
      a:hover {
        background-color: #c1f5ca;
      }

		 
		form {
			margin: 20px;
			padding: 20px;
			background-color: #a4f5b1;
			border-radius: 10px;
			box-shadow: 0px 0px 10px #888888;
			width: 400px;
		}
		label {
			display: block;
			margin-bottom: 5px;
		}
		input[type=text] {
			width: 100%;
			padding: 5px;
			margin-bottom: 10px;
			border: 1px solid #ccc;
			border-radius: 3px;
			box-sizing: border-box;
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type=submit]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<h1>Registro de Medicinas</h1>
	
	<center><form method="POST" >
		<label>Codigo:</label>
		<input type="text" name="codigo" required>
		<label>Nombre:</label>
		<input type="text" name="nombre" required>
		<label>Componentes:</label>
		<input type="text" name="componente" required>
		<label>Presentacion:</label>
		<input type="text" name="presentacion" required>
		<label>Precio</label>
		<input type="text" name="precio" required>
		<input type="submit" value="Registrar">
	</form>
</center>
<ul>
<li><a href="menu.html">Menu Principal</a></li>
</ul>
<?php  
// Parámetros de la conexión a la base de datos
$host = "localhost";
$dbname = "medicina";
$username = "root";
$password = "";

// Crear una conexión a la base de datos utilizando PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

// Procesar el formulario
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Obtener los valores del formulario
	$codigo = $_POST["codigo"];
	$nombre = $_POST["nombre"];
	$componente = $_POST["componente"];
	$presentacion = $_POST["presentacion"];
	$precio = $_POST["precio"];

	// Ejecutar una consulta SQL para insertar los valores en la tabla "medicina"
	try {
	    // Preparar una consulta SQL con marcadores de posición
	    $stmt = $conn->prepare("INSERT INTO medicamento(codigo, nombre, componentes, presentacion, precio) VALUES (:codigo,:nombre,:componente,:presentacion,:precio)");
	    // Vincular los valores de las variables a los marcadores de posición
	    $stmt->bindParam(':codigo', $codigo);
	    $stmt->bindParam(':nombre', $nombre);
	    $stmt->bindParam(':componente', $componente);
	    $stmt->bindParam(':presentacion', $presentacion);
	    $stmt->bindParam(':precio', $precio);
	    // Ejecutar la consulta
	    $stmt->execute();
	    echo "Registro insertado correctamente";
	} catch(PDOException $e){
	    echo "Error al insertar el registro: " . $e->getMessage();
	}
}

// Cerrar la conexión a la base de datos
$conn = null;
?>
</body>
</html>