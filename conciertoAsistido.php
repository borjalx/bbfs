<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'f' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
$nombre = $_SESSION["nombre_u"];

if(isset($_POST['apuntar'])){
    $concierto = $_POST['concierto'];
    
    if(!comprobarConciertoAsistido($email, $concierto)){
        apuntarConciertoAsistido($email, $concierto);
    }else{
        echo "Ya sabemos que has asistido a ese concierto ;)<br>";
        echo '<a href="conciertoAsistido.php">Volver a escoger</a>';
    }
    
}else{
    

?>
<form method="POST" action="">
    
    Conciertos: 
    <select name="concierto">
        <?php
    $ranking = conciertosCelebrados();
    while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
    echo "<option value='$idconcierto'>$nombre</option>";
}
        ?>
    </select>
    <input type="submit" name="apuntar" value="apuntar">
</form>

<?php
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