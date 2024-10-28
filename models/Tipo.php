<?php
    class Tipo extends Conectar{
        public function insert_tipo($tipo_nom){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO tipos (tipo_id, tipo_nom, fech_crea, est) 
                                VALUES (NULL,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipo_nom);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_tipo($tipo_id,$tipo_nom){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tipos
                SET
                    tipo_nom = ?
                WHERE
                    tipo_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipo_nom);
            $sql->bindValue(2, $tipo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_tipo($tipo_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tipos SET est=0 WHERE tipo_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function tipos(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tipos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function tipos_id($tipo_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tipos WHERE est = 1 AND tipo_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($tipo_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tipos SET est=1 WHERE tipo_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($tipo_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tipos SET est=0 WHERE tipo_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>