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
    $select = "select nombre_ciudad from ciudad where idciudad = '$id_ciudad'";
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
               where usuario.idgenero = '$genero' and concierto.estado = 'p'";
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function apuntaraConcierto($idconcierto,$mail_grupo,$fecha){
    $con = conexion("bbfs");
    $consulta = "INSERT INTO apuntar VALUES ('$idconcierto', '$mail_grupo', '$fecha','n')";

    if (mysqli_query($con, $consulta)) {
        echo "Apuntado correctamente<br>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function crearConcierto($nombre,$fecha,$hora,$precio,$mail,$idgenero){
    $con = conexion("bbfs");
    $consulta = "INSERT INTO concierto (nombre,estado,fecha,hora,precio,email_local,idgenero) VALUES ('$nombre','p','$fecha','$hora','$precio','$mail','$idgenero')";
    
    if (mysqli_query($con, $consulta)) {
        echo "Creado correctamente<br>";
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

function comprobarVotoConcierto($email,$idconcierto){
    $conectar = conexion("bbfs");
    $consulta = "select * from votar_concierto where mail_fan ='$email' and idconcierto ='$idconcierto'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador > 0){
        return true;
    }else {
        return false;
    } 
}

function votarConcierto($email,$idconcierto,$voto){
    $con = conexion("bbfs");
    $select = "insert into votar_concierto values ('$idconcierto','$email',now(),'$voto')";
    
    
    if (mysqli_query($con, $select)) {
        if($voto == 0){
            echo "Voto negativo<br>";            
        }else if($voto == 1){
            echo "Voto positivo<br>";
        }        
        echo "<a href='votarConcierto.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function comprobarVotoMusico($email_fan,$idconcierto){
    $conectar = conexion("bbfs");
    $consulta = "select * from votar_musico where mail_fan ='$email_fan' and idconcierto ='$idconcierto'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador > 0){
        return true;
    }else {
        return false;
    } 
}

function votarMusico($email_fan,$email_musico,$voto,$idconcierto){
    $con = conexion("bbfs");
    $select = "insert into votar_musico values ('$email_musico','$email_fan',now(),'$voto',$idconcierto)";
     
   if (mysqli_query($con, $select)) {
        if($voto == 0){
            echo "Voto negativo<br>";            
        }else if($voto == 1){
            echo "Voto positivo<br>";
        }        
        echo "<a href='votarMusico.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function musicosApuntados_concierto($mail_local){
    $con = conexion("bbfs");
    $select = "select apuntar.* from apuntar
               inner join usuario on apuntar.mail_grupo = usuario.email
               inner join concierto on concierto.idconcierto = apuntar.idconcierto
               where concierto.email_local = '$mail_local' and concierto.musico_mail is null";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function musicosConcierto($idconcierto){
    $con = conexion("bbfs");
    $select = "select apuntar.* from apuntar
               inner join usuario on apuntar.mail_grupo = usuario.email
               inner join concierto on concierto.idconcierto = apuntar.idconcierto
               where concierto.idconierto = '$idconcierto'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function escogerMusico($idconcierto, $mail_musico){
    $con = conexion("bbfs");
    $consulta = "UPDATE concierto SET estado = 'a', musico_mail = '$mail_musico' WHERE idconcierto= '$idconcierto'";
                 
    
    if (mysqli_query($con, $consulta)) {
        echo "Modificada tabla concierto<br>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function escogerMusico2($idconcierto, $mail_musico){
    $con = conexion("bbfs");
    $consulta = "UPDATE apuntar SET aceptado = 1 WHERE idconcierto= '$idconcierto' and mail_grupo = '$mail_musico'";
                 
    
    if (mysqli_query($con, $consulta)) {
        echo "Modificada tabala apuntar <br>";
        echo "<a href='local.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}


function conciertoSinMusico(){
    $con = conexion("bbfs");
    $select = "select concierto.idconcierto,concierto.nombre, concierto.estado, concierto.fecha, concierto.hora, usuario.nombre as n_local, ciudad.nombre_ciudad
               from concierto inner join usuario on concierto.email_local = usuario.email
               inner join ciudad on ciudad.idciudad = usuario.idciudad
               where concierto.musico_mail is null and concierto.estado = 'p'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function conciertosCelebrados(){
    $con = conexion("bbfs");
    $select = "select * from concierto where fecha < now() and estado = 'a'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function apuntarConciertoAsistido($email, $idconcierto){
    $con = conexion("bbfs");
    $consulta = "insert into concierto_asistido (email_fan, idconcierto) values ('$email', '$idconcierto')";         
 
    if (mysqli_query($con, $consulta)) {
        echo "Apuntado a concierto asistido <br>";
        echo "<a href='fan.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function comprobarConciertoAsistido($email,$idconcierto){
    $conectar = conexion("bbfs");
    $consulta = "select * from concierto_asistido where email_fan ='$email' and idconcierto ='$idconcierto'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador > 0){
        return true;
    }else {
        return false;
    }
}

function comprobarMusicoConcierto($email_musico, $idconcierto){
    $conectar = conexion("bbfs");
    $consulta = "select * from concierto where musico_mail ='$email_musico' and idconcierto ='$idconcierto'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador > 0){
        return true;
    }else {
        return false;
    }
}

function comprobarApuntadoConcierto($email_musico, $idconcierto){
    $conectar = conexion("bbfs");
    $consulta = "select * from apuntar where mail_grupo ='$email_musico' and idconcierto ='$idconcierto'";
    
    $resultado = mysqli_query($conectar, $consulta);
    $contador = mysqli_num_rows($resultado);
    desconectar($conectar);
    if($contador > 0){
        return true;
    }else {
        return false;
    }
}


function conciertosAsistidos($email){
    $con = conexion("bbfs");
    $select = "select concierto.nombre, concierto.idconcierto 
                from concierto_asistido 
                inner join concierto on concierto.idconcierto = concierto_asistido.idc_asistido
                where email_fan = '$email'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function musicosConciertosAsistidos($email){
    $con = conexion("bbfs");
    $select = "select usuario.nombre as n_u, concierto.musico_mail, concierto.nombre as c_u from concierto 
inner join usuario on usuario.email = concierto.musico_mail where idconcierto in (
select idconcierto from concierto_asistido where email_fan = '$email')";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function mca2($email_fan,$email_musico){
    $con = conexion("bbfs");
    $select = "select usuario.nombre as n_u, concierto.musico_mail, concierto.idconcierto as idc from concierto 
               inner join usuario on usuario.email = concierto.musico_mail where musico_mail = '$email_musico' and idconcierto in (
               select idconcierto from concierto_asistido where email_fan = '$email_fan');";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function verPerfilMusico($email_musico){
    $con = conexion("bbfs");
    $select = "SELECT usuario.nombre, usuario.telefono, usuario.n_componentes,usuario.imagen, ciudad.nombre_ciudad, genero.nombre_genero
              FROM usuario 
              inner join ciudad on ciudad.idciudad = usuario.idciudad 
              inner join genero on genero.idgenero = usuario.idgenero 
              WHERE email='$email_musico'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function musicos(){
    $con = conexion("bbfs");
    $select = "select * from usuario where tipo = 'm'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}
function ccsma($email){
    $con = conexion("bbfs");
    $select = "select concierto.*,genero.nombre_genero from concierto
inner join genero on genero.idgenero = concierto.idgenero
where email_local = '$email' and musico_mail is null";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function cccma($email){
    $con = conexion("bbfs");
    $select = "select concierto.*,genero.nombre_genero,usuario.nombre as nombre_musico from concierto
inner join genero on genero.idgenero = concierto.idgenero
inner join usuario on usuario.email = concierto.musico_mail
where email_local = '$email' and musico_mail is not null;";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function calqtha($email){
    $con = conexion("bbfs");
    $select = "select apuntar.*,concierto.nombre 
               from apuntar 
               inner join concierto on concierto.idconcierto = apuntar.idconcierto
               where mail_grupo = '$email'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function conciertosaEliminar($email_local){
    $con = conexion("bbfs");
    $select = "select * from concierto where email_local = '$email_local' and fecha > now() and musico_mail is null";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function eliminarConcierto($idconcierto){
    $con = conexion("bbfs");
    $consulta = "DELETE FROM concierto WHERE idconcierto='$idconcierto'";        
 
    if (mysqli_query($con, $consulta)) {
        echo "Concierto eliminado correctamente <br>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function conciertosApuntados($musico_mail){
    $con = conexion("bbfs");
    $select = "select * from concierto where musico_mail = '$musico_mail'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function desapuntarConcierto($idconcierto){
    $con = conexion("bbfs");
    $consulta = "UPDATE concierto SET musico_mail = NULL, estado = 'p' WHERE idconcierto = '$idconcierto'";        
 
    if (mysqli_query($con, $consulta)) {
        echo "Concierto modificado <br>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function desapuntarConcierto2($idconcierto,$mail_musico){
    $con = conexion("bbfs");
    $consulta = "DELETE FROM apuntar WHERE idconcierto='$idconcierto' and mail_grupo = '$mail_musico'";        
 
    if (mysqli_query($con, $consulta)) {
        echo "Desapuntado correctamente <br>";
        echo "<a href='musico.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function conciertosModificables($email){
    $con = conexion("bbfs");
    $select = "select * from concierto where email_local = '$email' and estado = 'p'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function datosConcierto($idconcierto){
    $con = conexion("bbfs");
    $select = "select * from concierto where idconcierto = '$idconcierto'";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

function modificarConcierto($idconcierto, $nombre, $fecha, $hora, $precio, $idgenero){
    $con = conexion("bbfs");
    $consulta = "UPDATE concierto SET nombre = '$nombre', fecha = '$fecha', hora = '$hora', precio ='$precio', idgenero = '$idgenero' WHERE idconcierto = '$idconcierto'";
    
    if (mysqli_query($con, $consulta)) {
        echo "Concierto modificado correctamente <br>";
        echo "<a href='local.php'> Volver </a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function votosp($email_musico){
    $con = conexion("bbfs");
    $select = "select count(*) as n_v from votar_musico where voto = 1 and mail_musico = '$email_musico' group by voto";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}


function votosn($email_musico){
    $con = conexion("bbfs");
    $select = "select count(*) as n_v from votar_musico where voto = 0 and mail_musico = '$email_musico' group by voto";
    
    $resultado= mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}
?>
