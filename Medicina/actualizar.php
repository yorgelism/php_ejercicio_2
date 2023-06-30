<!DOCTYPE html>
<html>
<head>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #87ab8d;
      }
       ul {
        list-style: none;
        padding: 0;
        margin: 8;
        display: flex;
        flex-direcntion: column;
        align-items: center
        r
      }
      
      li {
        margin: 10px;
      }
      
      a {
        display: block;
        padding: 10px;
        background-color: #05f72d;
        color:  #101211;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
      }
      
      a:hover {
        background-color: #c1f5ca;}
    table {
      border-collapse:collapse;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
    }
    th {
      background-color: #ccc;
    }
    form {
      display: inline-block;
    }
    label {
      display: block;
      font-weight: bold;
      margin-top: 10px;
    }
    input[type=text] {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    input[type=submit] {
      background-color: #05f72d;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type=submit]:hover {
      background-color: #c1f5ca;
    }
  </style>
</head>
<body>
  <ul>
<li><a href="menu.html">volver al menu principal</a></li>
</ul>
</body>
</html>
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicina";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla "doc"
$sql = "SELECT * FROM medicamento";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table>";
  echo "<tr><th>Codigo</th><th>Nombre</th><th>Componentes</th><th>Presentacion</th><th>Precio</th><th>Editar</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["codigo"]."</td>";
    echo "<td>".$row["nombre"]."</td>";
    echo "<td>".$row["componentes"]."</td>";
    echo "<td>".$row["presentacion"]."</td>";
    echo "<td>".$row["precio"]."</td>";
    echo "<td><form action='' method='post'>
              <input type='hidden' name='codigo' value='".$row["codigo"]."'>
              <input type='submit' name='actualizar' value='Actualizar'>
          </form></td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron registros.";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Si se ha pulsado el botón de actualizar, mostrar el formulario
if(isset($_POST['actualizar'])){
  $codigo = $_POST['codigo'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "SELECT * FROM medicamento WHERE codigo='$codigo'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Actualizar registro</h2>";
    echo "<form action='' method='post'>";
    echo "<label>Codigo:</label><br>";
    echo "<input type='text' name='codigo' value='".$row["codigo"]."'><br>";
    echo "<label>Nombre:</label><br>";
    echo "<input type='text' name='nombre' value='".$row["nombre"]."'><br>";
    echo "<label>Componentes:</label><br>";
    echo "<input type='text' name='componentes' value='".$row["componentes"]."'><br>";
    echo "<label>Presentacion:</label><br>";
    echo "<input type='text' name='presentacion' value='".$row["presentacion"]."'><br>";
    echo "<label>Precio:</label><br>";
    echo "<input type='text' name='precio' value='".$row["precio"]."'><br>";
    echo "<input type='submit' name='submit' value='Actualizar'>";
    echo "</form>";
  }
  $conn->close();
}

// Si se ha enviado el formulario de actualización, actualizar los datos en la base de datos
if(isset($_POST['submit'])){
  $codigo = $_POST['codigo'];
  $nombre = $_POST['nombre'];
  $componente = $_POST['componentes'];
  $presentacion = $_POST['presentacion'];
  $precio = $_POST['precio'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "UPDATE medicamento SET nombre='$nombre', componentes='$componente', presentacion='$presentacion', precio='$precio',codigo='$codigo'";
  if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente.Actualiza la pagina si no se han cambiado los valores";
  } else {
    echo "Error al actualizar el registro: " . $conn->error;
  }
  $conn->close();
}
?>