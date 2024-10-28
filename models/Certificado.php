<?php
    class Certificado extends Conectar{
        /* TODO: Insertar registro  */
        public function insert_certificado($doc_id,$cer_nom){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="INSERT INTO certificado (cer_id,doc_id,cer_nom,fech_crea,est) VALUES (null,?,?,now(),1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$doc_id);
            $sql->bindParam(2,$cer_nom);
            $sql->execute();
        }

        public function get_cv_x_profesor($doc_id){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="SELECT * FROM certificado WHERE doc_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$doc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>