<?php
session_start();
/*Tengo error a la hora de autentificar el tipo de usuario (MAR)*/
if(strcasecmp($_SESSION['tipo_u'] , 'l' ) == 0){
require_once 'bbdd_bbfs.php';
$nombre = $_SESSION["nombre_u"];
$genero = $_SESSION["genero_u"];
$email = $_SESSION["email_u"];
//$n_ciudad = nombreCiudad($ciudad);
$ranking = musicosApuntados_concierto($email);

echo "<table>";
echo "<tr>";
echo "<th>ID Concierto</th> <th>Mail del grupo</th> <br>";
echo "</tr>";
while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
    /* Siempre después de extract las variables se llaman como en la bbdd
     */
    echo "<tr>";
    echo "<td>$idconcierto</td> <td>$mail_grupo</td>";
    echo "</tr>";
}
echo "</table>";
?>
<form method="post" action="">
    ID concierto
    <select name="idc">
        <?php
    $ranking2 = musicosApuntados_concierto($email);
    while ($fila = mysqli_fetch_array($ranking2)) {
    $resultado = array_unique($fila);
    extract($resultado);
    /* Siempre después de extract las variables se llaman como en la bbdd
     */
    echo "<option value='$idconcierto'>$idconcierto</option>";
}

        ?>
    </select>
    
    
 Musicos por Concierto
  <select name="m">
        <?php
    $ranking2 = musicosApuntados_concierto($email);
    while ($fila = mysqli_fetch_array($ranking2)) {
    extract($fila);
    /* Siempre después de extract las variables se llaman como en la bbdd
     */
    echo "<option name='$mail_grupo'>$mail_grupo</option>";
}
        ?>
    </select>

    <input type="submit" name="seleccionar" value="seleccionar"/>
</form>
<?php
if(isset($_POST['seleccionar'])){
    $concierto = $_POST['idc'];
    $musico = $_POST['m'];
    echo "IDconcierto = $concierto<br>";
    echo "Músico = $musico<br>";
    if(comprobarApuntadoConcierto($musico, $concierto)){
      escogerMusico($concierto, $musico);
      escogerMusico2($concierto, $musico);  
    }else{
        echo "El músico/grupo '$musico' no se ha apuntado al concierto '$concierto'";
    }
    
}
}
    else{
    /*
    echo "<h2>Login o Password Incorrectos</h2>";*/
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado");';
    echo '</script>';
    
}
?>