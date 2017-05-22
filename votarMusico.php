<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'f' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
$tipo = $_SESSION['tipo_u'];
$nombre = $_SESSION["nombre_u"];
if(isset ($_POST['verper'])){

$email_musico = $_POST['musico'];
header("location:verPerfil.php?email_m=$email_musico");
echo "<a href='votarMusico.php'> Volver </a>";
}else{

?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro FAN BBFsound</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/inicio-sesion.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
    </head>
    <div class="contenedor">
        <header>
            <div class="logo">
                <a href="home.php"><img src="imagenes/logo.png" width="" alt="BBFsound"></a>
            </div>
            <nav>
                <?php
                if($tipo == 'f'){
                echo '<a href="settings-fan.php">Settings</a>';
                echo '<a href="fan.php">Mi Perfil</a><br>';
                }else if($tipo == 'm'){
                echo '<a href="settings-musico.php">Settings</a>';
                echo '<a href="musico.php">Mi Perfil</a><br>';
                }else if($tipo == 'l'){
                echo '<a href="settings-local.php">Settings</a>';
                echo '<a href="local.php">Mi Perfil</a><br>';
                }
                ?>
                <a href="logout.php">SALIR</a>
            </nav>
        </header>
        <section class="main">
            <article>
                <form class="formulario" action="" method="POST">
                    <h2 class="titulo">Musico / Concierto:</h2>
                    <select name="musico">
                        <?php
                        $ranking = musicosConciertosAsistidos($email);
                        while ($fila = mysqli_fetch_array($ranking)) {
                        extract($fila);
                        echo "<option value='$musico_mail'>$n_u - $c_u</option>";
                        
                        }
                        
                        ?>
                    </select>
                    <input type="submit" name="votopos" value="Like">
                    <input type="submit" name="votoneg" value="Dislike">
                    <input type="submit" name="verper" value="Ver Perfil">
                </form>
            </article>
        </section>
        <footer>
            <div class="derechos-autor">
                <p>Todos los derechos reservados Copyright © BBFsound 2017.</p>
            </div>
            <section class="redes-sociales">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
            </section>
        </footer>
    </div>
</body>
</html>
<?php
if(isset($_POST['votopos'])){
$email_musico = $_POST['musico'];


$rankings = mca2($email,$email_musico);
while ($fila = mysqli_fetch_array($rankings)) {
extract($fila);
}

if(comprobarVotoMusico($email, $idc)){
echo "Ya has votado al musico";
echo "<a href='votarMusico.php'> Volver </a>";
}else{
votarMusico($email, $email_musico, true, $idc);
}


}else if(isset($_POST['votoneg'])){

$email_musico = $_POST['musico'];


$rankings = mca2($email,$email_musico);
while ($fila = mysqli_fetch_array($rankings)) {
extract($fila);
}

if(comprobarVotoMusico($email, $idc)){
echo "Ya has votado al musico";
}else{
votarMusico($email, $email_musico, false, $idc);
}
}
}
}else{
/*
echo "<h2>Login o Password Incorrectos</h2>";*/
echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
echo '<script type="text/javascript">';
echo 'alert("NO estás autentificado ");';
echo '</script>';

}
?>