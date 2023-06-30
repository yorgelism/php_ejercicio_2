<!DOCTYPE html>
<html>
<head>
  <title>Registro de Medicinas</title>
</head>
<body>
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
      }
      
      a:hover {
        background-color: #c1f5ca;
      }
    </style>

    <h1>Leer o borrar datos de los medicamentos registrados</h1>
</body>
</html>
<?php
// Conectarse a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "medicina");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se ha enviado un ID de registro para borrar
if (isset($_GET["borrar"])) {
    $codigo = $_GET["borrar"];
    $consulta = "DELETE FROM medicamento WHERE codigo ='$codigo'";
    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si el borrado fue exitoso
    if ($resultado) {
        echo "Registro borrado exitosamente.";
    } else {
        echo "Error al borrar el registro: " . mysqli_error($conexion);
    }
}

// Consultar los datos de la tabla "doc"
$consulta = "SELECT codigo, nombre, componentes, presentacion, precio FROM medicamento";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error de consulta: " . mysqli_error($conexion));
}

// Mostrar los datos en una tabla HTML
echo "<table border=1>";
echo "<tr><th>Codigo</th><th>Nombre</th><th>Componentes</th><th>Presentacion</th><th>Precio</th><th>Borrar</th></tr>";
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    
    echo "<td>" . $fila["codigo"] . "</td>";
    echo "<td>" . $fila["nombre"] . "</td>";
    echo "<td>" . $fila["componentes"] . "</td>";
    echo "<td>" . $fila["presentacion"] . "</td>";
    echo "<td>" . $fila["precio"] . "</td>";
    echo "<td><a href=\"?borrar=" . $fila["codigo"] . "\">Borrar</a></td>";
    echo "</tr>";
}
echo "</table>";

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body>
  
<ul>
<li><a href="menu.html">Menu Principal</a></li>
</ul>

</body>
</html>