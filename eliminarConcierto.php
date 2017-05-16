<?php
session_start();
/*Tengo error a la hora de autentificar el tipo de usuario (MAR)*/
if(isset($_SESSION["tipo_u"]) == 'l'){
require_once 'bbdd_bbfs.php';
$nombre_local = $_SESSION["nombre_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$aforo = $_SESSION["aforo_u"];
$direccion = $_SESSION["direccion_u"];
$genero = $_SESSION["genero_u"];
$email = $_SESSION["email_u"];
//$n_ciudad = nombreCiudad($ciudad);   
?>
<table>
    <tr>
        <th>ID concierto</th> <th>Nombre concierto</th> <th>Estado</th> <th>Fecha</th> <th>hora</th><br>
    </tr>
    <?php
    $conc = conciertosaEliminar($email);
    while ($fila = mysqli_fetch_array($conc)) {        
        extract($fila); 
        echo "<tr>";
        echo "<td>$idconcierto</td> <td>$nombre</td> <td>$estado</td> <td>$fecha</td> <td>$hora</td>";
        echo "</tr>";
    }
   ?>
</table>
<form action="" method="POST">
    ID del concierto : 
    <select name="idc">        
        <?php
        $conc = conciertosaEliminar($email_local);        
        while ($fila = mysqli_fetch_array($conc)){
            extract($fila);
            echo "<option value='$idconcierto'> $idconcierto</option>";            
        }
        ?>
    </select>
    <input type="submit" name="borrar" value="borrar">
</form>
<?php 
if(isset($_POST['borrar'])){ 
    $idconcierto = $_POST['idc'];   
    eliminarConcierto($idconcierto);
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