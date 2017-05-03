<?php

function conexion($database) {
    $conxn = mysqli_connect("localhost", "root", "", $database)
            or die("NO se ha podido conectar con la BBDD. MUERE!");
    return $conxn;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}

function rankingMusicos(){
    $con = conexion("bbfs");   
    $select = 'select usuario.nombre, count(*) as Votos from usuario inner join votar_musico on usuario.email = votar_musico.mail_musico where email in(select mail_musico from votar_musico) group by usuario.nombre order by Votos desc';
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function agendaConciertos(){
    $con = conexion("bbfs"); 
    $select = 'select concierto.nombre,concierto.fecha,genero.nombre_genero from concierto inner join genero on concierto.idgenero = genero.idgenero order by fecha desc';
   
    $resultado= mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function registrarFan($email,$contraseña,$nombre,$apellidos,$telefono,$ciudad,$sexo,$genero,$año_nacimiento){
    $con = conexion("bbfs");
    $insert = "INSERT INTO `bbfs`.`usuario` (`email`, `pass`, `tipo`, `nombre`, `apellidos`, `telefono`, `idciudad`, `sexo`, `idgenero`, `anacimiento`) VALUES ('$email', '$contraseña', 'f', '$nombre', '$apellidos', '$telefono', '$ciudad', '$sexo', '$genero','$año_nacimiento')";
    
    if(mysqli_query($con, $insert)){
        echo "Se ha dado de alta correctamente<br>";
        echo "<a href='home.php'>Volver al home</a>";
    }else{
        echo "ERROR!";
        echo mysqli_error($con);
    }
}

function registrarLocal($email,$nombre,$telefono,$ciudad, $genero, $aforo, $direccion, $contraseña){
    
    $con = conexion("bbfs");
    $insert = "INSERT INTO `bbfs`.`usuario` (`email`, `tipo`, `nombre`, `telefono`, `idciudad`, `idgenero`, `aforo`, `direccion`, `pass`) VALUES ('$email', 'l', '$nombre', '$telefono', '$ciudad', '$genero', '$aforo', '$direccion', '$contraseña')";
    
    if(mysqli_query($con, $insert)){
        echo "Se ha dado de alta correctamente<br>";
        echo "<a href='home.php'>Volver al home</a>";
    }else{
        echo "ERROR!";
        echo mysqli_error($con);
    }
}

function registrarMusico($email,$nombre,$telefono,$ciudad, $genero, $ncomponentes, $contraseña){
    
    $con = conexion("bbfs");
    $insert = "INSERT INTO `bbfs`.`usuario` (`email`, `tipo`, `nombre`, `telefono`, `idciudad`, `idgenero`, `n_componentes`, `pass`) VALUES ('$email', 'm', '$nombre', '$telefono', '$ciudad', '$genero', '$ncomponentes', '$contraseña')";

    if(mysqli_query($con, $insert)){
        echo "Se ha dado de alta correctamente<br>";
        echo "<a href='home.php'>Volver al home</a>";
    }else{
        echo "ERROR!";
        echo mysqli_error($con);
    }
}

function existeUsuario($email){
    $conectar = conexion("bbfs");
    $consulta = "select * from usuario where email = '$email'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador == 0){
        return false;
    }else {
        return true;
    }
}

function inicioSesion($email,$password){
    session_start();
    $link = conexion("bbfs");

    
    $query = "SELECT *
              FROM usuario 
              inner join ciudad on ciudad.idciudad = usuario.idciudad 
              inner join genero on genero.idgenero = usuario.idgenero 
              WHERE email='$email' && pass = '$password'";
    $result = mysqli_query($link,$query);
    echo $query;
    if (mysqli_num_rows($result)) {
        $array = mysqli_fetch_array($result);

        $_SESSION["tipo_u"] = $array["tipo"];
        //$_SESSION["idg_u"] = $array["idgenero"];

        if ($array["tipo"] == 'f') {
            $_SESSION["email_u"] = $array["email"];
            $_SESSION["nombre_u"] = $array["nombre"];
            $_SESSION["apellido_u"] = $array["apellidos"];
            $_SESSION["tel_u"] = $array["telefono"];
            $_SESSION["ciudad_u"] = $array["nombre_ciudad"];
            $_SESSION["sexo_u"] = $array["sexo"];
            $_SESSION["genero_u"] = $array["nombre_genero"];
            $_SESSION["nacimiento_u"] = $array["anacimiento"];
            
            header("Location:fan.php");
            
        } else if ($array["tipo"] == 'l') {
            $_SESSION["email_u"] = $array["email"];
            $_SESSION["nombre_u"] = $array["nombre"];
            $_SESSION["tel_u"] = $array["telefono"];
            $_SESSION["ciudad_u"] = $array["nombre_ciudad"];
            $_SESSION["genero_u"] = $array["nombre_genero"];
            $_SESSION["idg_u"] = $array["idgenero"];
            $_SESSION["aforo_u"] = $array["aforo"];
            $_SESSION["direccion_u"] = $array["direccion"];
            //$_SESSION["idg_u"] = $array["idgenero"];
            header("Location:local.php");
            
        } else if ($array["tipo"] == 'm') {
            $_SESSION["email_u"] = $array["email"];
            $_SESSION["nombre_u"] = $array["nombre"];
            $_SESSION["tel_u"] = $array["telefono"];
            $_SESSION["ciudad_u"] = $array["nombre_ciudad"];
            $_SESSION["genero_u"] = $array["nombre_genero"];
            $_SESSION["nc_u"] = $array["n_componentes"];
            $_SESSION["idg_u"] = $array["idgenero"];
            
            header("Location:musico.php");
        }
        }else{
            /*
            echo "<h2>Login o Password Incorrectos</h2>";*/
            echo '<script type="text/javascript">';
            echo 'alert("Login o Password incorrecto");';
            echo '</script>';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
        }
}

function nombreCiudad($id_ciudad){
    $con = conexion("bbfs");   
    $select = "select nombre_ciudad from ciudad where idciudad = '4'";
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function nombreGenero($id_genero){
    $con = conexion("bbfs");   
    $select = "select nombre_genero from genero where idgenero = '$id_genero'";
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function conciertosxciudad($email_u){
    $con = conexion("bbfs");
    $select = "select concierto.nombre as nombre_c,concierto.estado,concierto.fecha,concierto.hora,concierto.precio,usuario.idciudad,usuario.nombre as nombre_l,ciudad.nombre_ciudad,genero.nombre_genero 
                from concierto 
                inner join usuario on concierto.email_local = usuario.email 
                inner join ciudad on ciudad.idciudad = usuario.idciudad
                inner join genero on genero.idgenero = usuario.idciudad
                where concierto.estado = 'a' and usuario.idciudad = (select idciudad from usuario where email = '$email_u')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
    
}

function conciertosxgenero_m($email_u){
    $con = conexion("bbfs");
    $select = "select concierto.nombre as nombre_c,concierto.estado,concierto.fecha,concierto.hora,concierto.precio,usuario.idciudad,usuario.nombre as nombre_l,ciudad.nombre_ciudad,genero.nombre_genero 
                from concierto 
                inner join usuario on concierto.email_local = usuario.email 
                inner join ciudad on ciudad.idciudad = usuario.idciudad
                inner join genero on genero.idgenero = usuario.idciudad
                where concierto.estado = 'p' and usuario.idgenero = (select idgenero from usuario where email = '$email_u')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
    
}

function conciertosxciudad_m($email_u){
    $con = conexion("bbfs");
    $select = "select concierto.nombre as nombre_c,concierto.estado,concierto.fecha,concierto.hora,concierto.precio,usuario.idciudad,usuario.nombre as nombre_l,ciudad.nombre_ciudad,genero.nombre_genero 
                from concierto 
                inner join usuario on concierto.email_local = usuario.email 
                inner join ciudad on ciudad.idciudad = usuario.idciudad
                inner join genero on genero.idgenero = usuario.idciudad
                where concierto.estado = 'p' and usuario.idciudad = (select idciudad from usuario where email = '$email_u')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
    
}

function conciertosxgenero($email_u){
    $con = conexion("bbfs");
    $select = "select concierto.nombre as nombre_c,concierto.estado,concierto.fecha,concierto.hora,concierto.precio,usuario.idciudad,usuario.nombre as nombre_l,ciudad.nombre_ciudad,genero.nombre_genero 
                from concierto 
                inner join usuario on concierto.email_local = usuario.email 
                inner join ciudad on ciudad.idciudad = usuario.idciudad
                inner join genero on genero.idgenero = usuario.idciudad
                where concierto.estado = 'a' and usuario.idgenero = (select idgenero from usuario where email = '$email_u')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
    
}
/*No se actualiza el perfil despues de actualizar datos*/
function editarFan($email,$nombre,$apellidos,$telefono,$ciudad,$genero){
    $con = conexion("bbfs");
    $insert = "UPDATE usuario set nombre='$nombre',apellidos='$apellidos', telefono='$telefono', idciudad='$ciudad', idgenero='$genero' where email='$email'";
    
    if(mysqli_query($con, $insert)){
        echo "Usuario modificado correctamente<br>";
        echo "<a href='fan.php'>Volver al perfil</a>";
    }else{
        echo "ERROR!";
        echo mysqli_error($con);
    }
}

function editarMusico($email,$nombre,$telefono,$ciudad,$genero,$ncomponentes){
    $con = conexion("bbfs");
    $insert = "UPDATE usuario set nombre='$nombre',n_componentes='$ncomponentes', telefono='$telefono', idciudad='$ciudad', idgenero='$genero' where email='$email'";
    
    if(mysqli_query($con, $insert)){
        echo "Usuario modificado correctamente<br>";
        echo "<a href='musico.php'>Volver al perfil</a>";
    }else{
        echo "ERROR!";
        echo mysqli_error($con);
    }
}

function editarLocal($email,$nombre,$telefono,$ciudad,$genero,$aforo,$direccion){
    $con = conexion("bbfs");
    //$nombre', '$telefono', '$ciudad', '$genero', '$aforo', '$direccion',
    $insert = "UPDATE usuario set nombre='$nombre', telefono='$telefono', idciudad='$ciudad', idgenero='$genero', aforo = '$aforo', direccion = '$direccion' where email='$email'";
    
    if(mysqli_query($con, $insert)){
        echo "Usuario modificado correctamente<br>";
        echo "<a href='local.php'>Volver al perfil</a>";
    }else{
        echo "ERROR!";
        echo mysqli_error($con);
    }
}
    
function cambiarPass($email,$contraseña,$tipo){
    $con = conexion("bbfs");
    $consulta = "UPDATE usuario SET pass='$contraseña' WHERE email='$email'";

    if (mysqli_query($con, $consulta)) {
        echo "Contraseña modificada<br>";
        if($tipo == 'f'){
            echo "<a href='fan.php'>Volver al menú<a>";
        }else if($tipo == 'l'){
            echo "<a href='local.php'>Volver al menú<a>";
        }else if($tipo == 'm'){
            echo "<a href='musico.php'>Volver al menú<a>";
        }
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}


function verificarUsuario($email,$contraseña){
    
    $conectar = conexion("bbfs");
    $consulta = "select * from usuario where email='$email' and pass='$contraseña'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador > 0){
        return true;
    }else {
        return false;
    }

}

function conciertosDisponibles($genero){
    $con = conexion("bbfs");
    $select = "select concierto.idconcierto,concierto.nombre, concierto.estado, concierto.fecha, concierto.hora, usuario.nombre as n_local, ciudad.nombre_ciudad
               from concierto inner join usuario on concierto.email_local = usuario.email
               inner join ciudad on ciudad.idciudad = usuario.idciudad
               where usuario.idgenero = '$genero'";
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function apuntaraConcierto($idconcierto,$mail_grupo,$fecha){
    $con = conexion("bbfs");
    $consulta = "INSERT INTO apuntar VALUES ('$idconcierto', '$mail_grupo', '$fecha','n')";

    if (mysqli_query($con, $consulta)) {
        echo "Apuntado correctamente<br>";
        echo "<a href='musico.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function crearConcierto($nombre,$fecha,$hora,$precio,$mail,$idgenero){
    $con = conexion("bbfs");
    $consulta = "INSERT INTO concierto VALUES (null,'$nombre','p','$fecha','$hora','$precio','$mail','$idgenero')";
    
    if (mysqli_query($con, $consulta)) {
        echo "Creado correctamente<br>";
        echo "<a href='local.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function musicosxc($idciudad){
    $con = conexion("bbfs");
    $select = "select usuario.nombre, usuario.email, usuario.telefono, usuario.n_componentes, genero.nombre_genero
               from usuario 
               inner join genero on genero.idgenero = usuario.idgenero
               where usuario.idciudad = '$idciudad'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function musicosxg($idgenero){
    $con = conexion("bbfs");
    $select = "select usuario.nombre, usuario.email, usuario.telefono, usuario.n_componentes, ciudad.nombre_ciudad
               from usuario 
               inner join ciudad on ciudad.idciudad = usuario.idciudad
               where usuario.idgenero = '$idgenero'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function votarConcierto($email,$idconcierto,$fecha){
    $con = conexion("bbfs");
    $select = "insert into votar_concierto values ('$idconcierto','$email','$fecha')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function votarMusico($email_fan,$email_musico,$fecha){
    $con = conexion("bbfs");
    $select = "insert into votar_concierto values ('$email_musico','$email_fan','$fecha')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}
?>
