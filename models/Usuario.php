<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $usu_correo = $_POST["correo"];
                $usu_pass = $_POST["passwd"];

                if(empty($usu_correo) and empty($usu_pass)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    
                    $sql = "SELECT * FROM usuarios WHERE usu_correo=? and usu_pass=MD5(?) and est=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_correo);
                    $stmt->bindValue(2,$usu_pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    var_dump($resultado);
                    
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["usu_correo"]=$resultado["usu_correo"];
                        $_SESSION["usu_rol"]=$resultado["usu_rol"];
                        if($resultado["usu_rol"] == "ADMO"){
                            header("Location:".Conectar::ruta()."views/inicio.php");
                            exit();
                        }elseif($resultado["usu_rol"] == "DOC"){
                            header("Location:".Conectar::ruta()."views/admDocente.php");
                            exit();
                        }else{
                            header("Location:".Conectar::ruta()."views/index.php");
                            exit();
                        }
                        
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        } 
        
        public function insert_usuario($usu_nom,$usu_ape,$usu_correo,$usu_pass,$usu_rol){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuarios (usu_id, usu_nom, usu_ape, usu_correo, usu_pass, usu_rol, fech_crea, est) VALUES (NULL,?,?,?,MD5(?),?,now(),'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $usu_rol);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_perfil($usu_id,$usu_pass){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios 
                    SET 
                    usu_pass = MD5(?),
                    fech_mod = now()
                    WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_pass);
            $sql->bindValue(2,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_usuario($usu_id, $usu_nom, $usu_ape, $usu_pass, $usu_rol){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuarios
                SET
                    usu_nom = ?,
                    usu_ape = ?,
                    usu_pass = MD5(?),
                    usu_rol = ?,
                    fech_mod = now()
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_pass);
            $sql->bindValue(4, $usu_rol);
            $sql->bindValue(5, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET est=1 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function listar(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuarios";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario_id($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuarios WHERE est = 1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario_x_rol(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuarios where est=1 and usu_rol='ADMO' OR usu_rol='ASPI'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_profesores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM docentes WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_programas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM programas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        

       
       

    }
?>