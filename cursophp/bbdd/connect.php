<?php

$dsn = 'mysql:host=localhost;dbname=ejemplo_db';
$usuario = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $usuario, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa<br>";
    //Consulta
    // Preparar y ejecutar la consulta
    $sql = "SELECT id, nombre, email FROM usuarios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtener los resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los resultados en una tabla HTML
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Email</th></tr>";
    foreach ($resultados as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre'] . "</td>";
        echo "<td>" . $fila['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";


   //INSERTAR
   // Datos a insertar
   $email = 'nuevo_usuario@example.com';
   $nombre = 'Nuevo Usuario';

   // Preparar la consulta de inserción
   $sql = "INSERT INTO usuarios (email, nombre) VALUES (:email, :nombre)";
   $stmt = $conn->prepare($sql);

   // Vincular los parámetros
   $stmt->bindParam(':email', $email);
   $stmt->bindParam(':nombre', $nombre);

   // Ejecutar la consulta
   $stmt->execute();
   echo "Inserción exitosa";

   //MODIFICAR
   // ID del usuario a modificar
   $id_usuario = 1; // Asegúrate de que este ID corresponde al usuario que insertaste
   $nuevo_nombre = 'Nombre Actualizado';

   // Preparar la consulta de actualización
   $sql = "UPDATE usuarios SET nombre = :nombre WHERE id = :id";
   $stmt = $conn->prepare($sql);

   // Vincular los parámetros
   $stmt->bindParam(':nombre', $nuevo_nombre);
   $stmt->bindParam(':id', $id_usuario);

   // Ejecutar la consulta
   $stmt->execute();
   echo "Modificación exitosa";
   //ELIMINAR
   // ID del usuario a eliminar
   $id_usuario = 1;

   // Preparar la consulta de eliminación
   $sql = "DELETE FROM usuarios WHERE id = :id";
   $stmt = $conn->prepare($sql);

   // Vincular el parámetro
   $stmt->bindParam(':id', $id_usuario);

   // Ejecutar la consulta
   $stmt->execute();
   echo "Eliminación exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
