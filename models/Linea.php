<?php
    class Linea extends Conectar{
        public function insert_linea($lin_nom){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO lineas (lin_id, lin_nom, fech_crea, est) 
                                VALUES (NULL,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lin_nom);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_linea($lin_id,$lin_nom){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lineas
                SET
                    lin_nom = ?
                WHERE
                    lin_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lin_nom);
            $sql->bindValue(2, $lin_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_linea($lin_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lineas SET est=0 WHERE lin_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lin_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function lineas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM lineas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function lineas_id($lin_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM lineas WHERE est = 1 AND lin_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lin_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($lin_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lineas SET est=1 WHERE lin_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lin_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($lin_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lineas SET est=0 WHERE lin_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lin_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>