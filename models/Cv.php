<?php
    class Cv extends Conectar{
        /* TODO: Insertar registro  */
        public function insert_cv($doc_id,$cv_nom){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="INSERT INTO cv (cv_id,doc_id,cv_nom,fech_crea,est) VALUES (null,?,?,now(),1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$doc_id);
            $sql->bindParam(2,$cv_nom);
            $sql->execute();
        }

        public function get_cv_x_profesor($doc_id){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="SELECT * FROM cv WHERE doc_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$doc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>