<?php
    class Programa extends Conectar{
        public function insert_programa($prog_codigo, $prog_nom, $prog_sigla){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO programas (prog_id, prog_codigo, prog_nom, prog_sigla, fech_crea, est) 
                                VALUES (NULL,?,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prog_codigo);
            $sql->bindValue(2, $prog_nom);
            $sql->bindValue(3, $prog_sigla);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_programa($prog_id,$prog_codigo,$prog_nom,$prog_sigla){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE programas
                SET
                    prog_codigo = ?,
                    prog_nom = ?,
                    prog_sigla = ?
                WHERE
                    prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prog_codigo);
            $sql->bindValue(2, $prog_nom);
            $sql->bindValue(3, $prog_sigla);
            $sql->bindValue(4, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_programa($prog_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE programas SET est=0 WHERE prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prog_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function programas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM programas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function programas_id($prog_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM programas WHERE est = 1 AND prog_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prog_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($prog_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE programas SET est=1 WHERE prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prog_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($prog_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE programas SET est=0 WHERE prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prog_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>