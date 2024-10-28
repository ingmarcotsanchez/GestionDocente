<?php
    class Modalidad extends Conectar{
        public function insert_modalidad($mod_codigo, $mod_nom){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO modalidades (mod_id, mod_codigo, mod_nom, fech_crea, est) 
                                VALUES (NULL,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $mod_codigo);
            $sql->bindValue(2, $mod_nom);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_modalidad($mod_id,$mod_codigo,$mod_nom){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE modalidades
                SET
                    mod_codigo = ?,
                    mod_nom = ?
                WHERE
                    mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $mod_codigo);
            $sql->bindValue(2, $mod_nom);
            $sql->bindValue(3, $mod_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_modalidad($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE modalidades SET est=0 WHERE mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function modalidades(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM modalidades";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function modalidades_id($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM modalidades WHERE est = 1 AND mod_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE modalidades SET est=1 WHERE mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE modalidades SET est=0 WHERE mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>