<?php
session_start();
require_once 'bbdd_bbfs.php';
$email_musico = $_GET['email_m'];

$ranking = verPerfilMusico($email_musico);

while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
?>
<aside>
    <div class="imagen"></div>
    <h2><?php echo "$nombre";?></h2>
    <p>
    <div>Nombre : <?php echo $nombre;?></div>
    <div>Ciudad : <?php echo $nombre_ciudad;?></div>
    <div>Teléfono : <?php echo $telefono;?></div>
    <div>Genero : <?php echo $nombre_genero;?></div>
    <div>Nº componentes : <?php echo $n_componentes;?></div>
    </p>
    <div class="imagen"></div>
    <a href="votarMusico.php"> Volver </a>
</aside>
<?php
}
?>


