<?php
session_start();
require_once 'bbdd_bbfs.php';
    
$email = $_SESSION["email_u"];
if(isset($_POST['editar'])){
        $name = $_POST['name'];
        $surn = $_POST['surn'];
        $tel = $_POST['tel'];
        $town = $_POST['town'];
        $gender = $_POST['gender'];
        editarFan($email, $name, $surn, $tel, $town, $gender);

}else if (isset($_SESSION["tipo_u"]) == 'f') {

    $nombre = $_SESSION["nombre_u"];
    $apellido = $_SESSION["apellido_u"];
    $telefono = $_SESSION["tel_u"];
    $ciudad = $_SESSION["ciudad_u"];
    $sexo = $_SESSION["sexo_u"];
    $genero = $_SESSION["genero_u"];
    $nacimiento = $_SESSION["nacimiento_u"];

//$n_ciudad = nombreCiudad($ciudad);

        
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
        </head>
        <body>
            <div>
                <h2><?php echo "$nombre $apellido"; ?></h2>
                <form action="" method="POST">
                    <p> Nombre : </p>
                    <input type="text" name="name" value="<?php echo $nombre; ?>"/>
                    <p> Apellido : </p>
                    <input type="text" name="surn" value="<?php echo $apellido; ?>"/>
                    <p> Telefono : </p>
                    <input type="text" name="tel" value="<?php echo $telefono; ?>"/>
                    <p> Ciudad : </p>
                    <select name="town" selected="<?php echo $ciudad; ?>">
                        <option value="4">Madrid</option>
                        <option value="2">Barcelona</option>
                        <option value="1">Valencia</option>
                        <option value="3">Sevilla</option>
                        <option value="10">Zaragoza</option>
                        <option value="5">Malaga</option>
                        <option value="6">Murcia</option>
                        <option value="7">Mallorca</option>
                        <option value="8">Gran Canaria</option>
                        <option value="9">Bilbao</option>
                    </select>
                    <p>Genero musical favorito:</p>
                    <select name="gender">
                        <option value="1">Rock</option>
                        <option value="2">Rap</option>
                        <option value="5">Electrónica</option>
                        <option value="6">Hip Hop</option>
                        <option value="3">Trap</option>
                        <option value="7">Pop</option>
                        <option value="8">Reggae</option>
                        <option value="9">Jazz</option>
                        <option value="10">Reggaeton</option>
                        <option value="4">Bachata</option>
                    </select>
                    <input type="submit" name="editar" value="editar">
                </form>
                <a href="fan.php"> Volver a página de fan</a><br>
                <a href="cambiarPass.php"> Cambiar contraseña</a>
            </div>
            <?php
            // put your code here
            ?>
        </body>
    </html>
    <?php
        }
 else {
    /*
      echo "<h2>Login o Password Incorrectos</h2>"; */
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado ");';
    echo '</script>';
}
?>