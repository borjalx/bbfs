<?php
session_start();
if(isset($_SESSION["tipo_u"]) == 'm'){
require_once 'bbdd_bbfs.php';
$nombre = $_SESSION["nombre_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$genero = $_SESSION["genero_u"];
$nc = $_SESSION["nc_u"];
$email = $_SESSION["email_u"];
$idg = $_SESSION["idg_u"];

//$n_ciudad = nombreCiudad($ciudad);
if(isset($_POST['escoger1'])){
    $idc = $_POST['con_c'];
    echo $idc;
    $hoy = getdate();
    $date = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
    echo $email;
    echo $date;
    apuntaraConcierto($idc, $email, $date);
}else {
?>
<table>
    <tr>
        <th>ID concierto</th> <th>Nombre concierto</th> <th>Estado</th> <th>Fecha</th> <th>hora</th> <th>Local</th> <th>Ciudad</th><br>
    </tr>
    <?php
    $conc = conciertosDisponibles($idg);
    while ($fila = mysqli_fetch_array($conc)) {        
        extract($fila);

        echo "<tr>";
        echo "<td>$idconcierto</td> <td>$nombre</td> <td>$estado</td> <td>$fecha</td> <td>$hora</td> <td>$n_local</td> <td>$nombre_ciudad</td>";
        echo "</tr>";
    }
   ?>
</table>
<form action="" method="POST">
    ID del concierto : 
    <select name="con_c">        
        <?php
        $conc = conciertosDisponibles($idg);        
        while ($fila = mysqli_fetch_array($conc)){
            extract($fila);
            echo "<option value='$idconcierto'> $idconcierto</option>";
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