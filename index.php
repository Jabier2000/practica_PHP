<!DOCTYPE html>

    <?php require('conexion.php'); //Carga la variable 'conn' para conectar con la base de datos?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form method="post" action="">
        <fieldset>
        <legend>Formulario</legend>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br><br>
            <input type="email" id="correo" name="correo" placeholder="Correo" required><br><br>
            <button type="submit">Enviar</button>
        </fieldset>
    </form>

    <?php
        if (!empty($_POST['nombre']) && !empty($_POST['correo'])) {
            echo "Recibe el nombre: " . $_POST['nombre'] . "<br>";
            echo "Recibe el correo: " . $_POST['correo'] . "<br>";

            $nombreCarga = $_POST['nombre'];
            $correoCarga = $_POST['correo'];
            
            //--- Aplicable a Sentencias INSERT, UPDATE, DELETE ---//
            $state = $conn->prepare("INSERT INTO registros (nombre, correo) VALUES (:nombreChido, :correoChido)");

            $state->bindParam(":nombreChido", $nombreCarga);
            $state->bindParam(":correoChido", $correoCarga);

            $state->execute();
            
            //------------------------------------//
            //--- Aplicable a Sentencia SELECT ---//
            
            $sql = "SELECT * FROM registros";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // Configura los resultados como un arreglo asociativo
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            // $stmt->fetchAll() Obtiene el arreglo asociativo
            echo "<ul>";
            foreach ($stmt->fetchAll() as $row) {
                echo "<li>" . $row['ID'] . " - " . $row['nombre'] . " " . $row['correo'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h3>Faltan datos</h3>";
        }
    ?>

</body>
</html>