<?php
session_start();
if(isset($_SESSION["tipo_u"]) == 'm'){
require_once 'bbdd_bbfs.php';
$nombre_m = $_SESSION["nombre_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$genero = $_SESSION["genero_u"];
$nc = $_SESSION["nc_u"];
$email = $_SESSION["email_u"];
$idg = $_SESSION["idg_u"];
//$n_ciudad = nombreCiudad($ciudad);
?>
<table>
    <tr>
        <th>ID concierto</th> <th>Nombre concierto</th> <th>Fecha</th> <th>hora</th><br>
    </tr>
    <?php
    $conc = conciertosApuntados($email);
    while ($fila = mysqli_fetch_array($conc)) {        
        extract($fila); 
        echo "<tr>";
        echo "<td>$idconcierto</td> <td>$nombre</td> <td>$fecha</td> <td>$hora</td>";
        echo "</tr>";
    }
   ?>
</table>
<form action="" method="POST">
    ID del concierto : 
    <select name="idc">        
        <?php
        $conc = conciertosApuntados($email);        
        while ($fila = mysqli_fetch_array($conc)){
            extract($fila);
            echo "<option value='$idconcierto'> $idconcierto</option>";            
        }
        ?>
    </select>
    <input type="submit" name="desapuntar" value="desapuntar">
</form>
<?php
if(isset($_POST['desapuntar'])){ 
    $idconcierto = $_POST['idc'];   
    desapuntarConcierto($idconcierto);
    desapuntarConcierto2($idconcierto, $email);
}
}else{
    /*
    echo "<h2>Login o Password Incorrectos</h2>";*/
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado");';
    echo '</script>';
    
}
?>