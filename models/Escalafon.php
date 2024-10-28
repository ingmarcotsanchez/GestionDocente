<?php
    class Escalafon extends Conectar{
        public function insert_escalafon($esc_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO escalafon (esc_id,esc_nombre, est) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $esc_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_escalafon($esc_id,$esc_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE escalafon
                SET
                    esc_nombre = ?
                WHERE
                    esc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $esc_nombre);
            $sql->bindValue(2, $esc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_escalafon($esc_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE escalafon SET est=0 WHERE esc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$esc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function escalafon(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM escalafon WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function escalafon_id($esc_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM escalafon WHERE est = 1 AND esc_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$esc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>