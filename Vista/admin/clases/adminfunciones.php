<?php
    

    function esNulo(array $parametros)
    {
        foreach($parametros as $parametros) {
        if(strlen(trim($parametros))<1){
            return true;
             }
        }
        return false;

    }




    function userExiste($usuario, $con)
    {

        $sql = $con->prepare("SELECT idusuario FROM usuario_cliente WHERE usuario LIKE ? LIMIT 1");
        $sql->execute([$usuario]); 
        if($sql->fetchColumn()>0){
            return true;
        }
        return false;

    }

    function dniExiste($dni, $con)
    {
        $sql = $con->prepare("SELECT idCliente FROM cliente WHERE dni LIKE ? LIMIT 1");
        $sql->execute([$dni]); 
        if($sql->fetchColumn()>0){
            return true;
        }
        return false;
    }
    

    function correoExiste($correo, $con)
    {

        $sql = $con->prepare("SELECT idCliente FROM cliente WHERE correo LIKE ? LIMIT 1");
        $sql->execute([$correo]); 
        if($sql->fetchColumn()>0){
            return true;
        }
        return false;

    }

    function registraUsuario(array $datos, $con)
    {

        $sql = $con->prepare("INSERT INTO usuario_cliente (usuario, password, token, id_cliente) VALUES(?,?,?,?)");
        if($sql->execute($datos)) {
            return $con->lastInsertId();
        }
        return 0;

    }

    function mostrarMensajes(array $errors){
        if(count($errors) > 0 ) {
           echo' <div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
           foreach($errors as $errors){
            echo  '<li>'. $errors .'</li>';
           }
           echo '<ul>';
           echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        }
    }


    function validaToken($id, $token, $con )
    {
        $msg="";
        $sql = $con->prepare("SELECT idusuario FROM usuario_cliente WHERE idusuario = ?  AND token LIKE ? LIMIT 1");
        $sql->execute([$id ,$token]); 
        if($sql->fetchColumn()>0){
            if(activarUsuario($id, $con)){
                $msg = "Cuenta activada";
            } else {
                $msg = "Error al activar cuenta";
            }
        }   else {
             $msg = "No existe el registro del cliente";
        }
        return $msg;

    }

    function activarUsuario($id,$con)
    {
        $sql = $con->prepare("UPDATE usuario_cliente SET activacion = 1, token = '' WHERE idusuario = ?");
        return $sql-> execute([$id]);

    }

    function login($usuario, $password, $con)
    {
        $sql = $con->prepare("SELECT idAdmin ,usuario, password, nombre FROM admin WHERE usuario
        LIKE ?  AND activo = 1 LIMIT 1");
        $sql->execute([$usuario]);

        if ($row = $sql->fetch(PDO::FETCH_ASSOC))
        {   
                if (password_verify($password,$row['password'])){
                    $_SESSION['user_id'] = $row['idAdmin'];
                    $_SESSION['user_name'] = $row['nombre'];
                    $_SESSION['user_type'] = 'admin';
                    header('Location : ../Dashboard.php');
                    exit;
                }
            } 
        
        return 'El usuario y/o contraseña son incorrectos.';
    }


    function solicitapassword($user_id, $con){

        $token = generartoken();

        $sql = $con ->prepare("UPDATE usuario_cliente SET token_password=?, password_request=1 WHERE idusuario = ?");
        if($sql->execute([$token,$user_id])){
            return $token;
        }
        return null;
    }

    function verificatokenrequest($user_id, $token, $con){
        $sql = $con->prepare("SELECT idusuario FROM usuario_cliente WHERE idusuario = ? AND token_password LIKE ? AND 
        password_request=1 LIMIT 1");
        $sql ->execute([$user_id, $token]);
        if($sql->fetchColumn() > 0){
            return true;
        }
        return false;
    }

    function actualizarpassword($user_id,$password,$con){
        $sql=$con->prepare("UPDATE usuario_cliente SET password = ?, token_password = '', password_request = 0 WHERE idusuario = ?");
        if($sql->execute([$password, $user_id])){
            return true;
        }
        return false;
    }
?>