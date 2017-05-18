<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'm' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];


//$n_ciudad = nombreCiudad($ciudad);
if(isset($_POST['escoger1'])){
    $idc = $_POST['con_c'];
    
    $hoy = getdate();
    $date = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];

    apuntaraConcierto($idc, $email, $date);
}else {
?>
<table>
    <tr>
        <th>ID concierto</th> <th>Nombre concierto</th> <th>Estado</th> <th>Fecha</th> <th>hora</th> <th>Local</th> <th>Ciudad</th><br>
    </tr>
    <?php
    $conc = conciertoSinMusico();
    while ($fila = mysqli_fetch_array($conc)) {        
        extract($fila);

        if(!comprobarApuntadoConcierto($email, $idconcierto)){
        echo "<tr>";
        echo "<td>$idconcierto</td> <td>$nombre</td> <td>$estado</td> <td>$fecha</td> <td>$hora</td> <td>$n_local</td> <td>$nombre_ciudad</td>";
        echo "</tr>";
        }
    }
   ?>
</table>
<form action="" method="POST">
    ID del concierto : 
    <select name="con_c">        
        <?php
        $conc = conciertoSinMusico();        
        while ($fila = mysqli_fetch_array($conc)){
            extract($fila);
            if(!comprobarApuntadoConcierto($email, $idconcierto)){
            echo "<option value='$idconcierto'> $idconcierto</option>";
            }
        }
        ?>
    </select>
    <input type="submit" name="escoger1" value="escoger">
</form>
<?php
}
}else{

    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado");';
    echo '</script>';
    
}
?>