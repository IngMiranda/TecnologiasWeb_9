<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    //obtener datos del formulario

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $fecha = $_POST['fecha'];
    $sexo = $_POST['sexo'];
    

    //crear la conexion a la base de datos
    $conn = new mysqli($servername,$username,$password,$dbname);

    //verificar conexion
    if($conn->connect_error){
        die("Error en la conexion a la base de datos: ".$conn->connect_error);
    }

    //crear la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO usuarios(nombre,email,pass,genero,fecha_nac)values('$nombre','$email','$pass','$sexo','$fecha')";

    //ejecutar la consulta y verificar si guardo correctamente
    if($conn->query($sql) == TRUE){
        echo "Los se guardaron correctamente";
        
    }else{
        echo "Error al guardar los datos: ".$conn->error;
    }

    //Cerrar 
    $conn->close();

?>
<html>
    <body>
        <br><br>
    <a href = "../formulario/index.html">Registrar Otro</a>
    <br><br>
    <a href="../tabla/index.php">Ver Tabla</a>";
</body>
</html>