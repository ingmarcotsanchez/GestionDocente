<?php
    class Cursos_profesor extends Conectar{
        /* TODO: Insertar registro  */
        public function insert_cursos_profesor($cur_image,$cur_prof_nom,$tipo_id,$cur_prof_anno,$doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            /* consulta sql */
            $sql="INSERT INTO cursos_profesor (cur_prof_id,cur_image,cur_prof_nom,tipo_id,cur_prof_anno,doc_id,fech_crea,est) 
                            VALUES (null,?,?,?,?,?,now(),1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$cur_image);
            $sql->bindParam(2,$cur_prof_nom);
            $sql->bindParam(3,$tipo_id);
            $sql->bindParam(4,$cur_prof_anno);
            $sql->bindParam(5,$doc_id);
            $sql->execute();
            $sql1="SELECT last_insert_id() as 'cur_prof_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function cursos_profesor_id($cur_prof_id){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="SELECT * FROM cursos_profesor WHERE cur_prof_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$cur_prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function cursos_profesor(){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="SELECT * FROM cursos_profesor";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function update_cursos_profesor($cur_prof_id,$cur_prof_nom,$tipo_id,$cur_prof_anno,$doc_id){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE cursos_profesor
                SET
                    cur_prof_nom = ?,
                    tipo_id = ?,
                    cur_prof_anno = ?,
                    doc_id = ?
                WHERE
                    cur_prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cur_prof_nom);
            $sql->bindValue(2, $tipo_id);
            $sql->bindValue(3, $cur_prof_anno);
            $sql->bindValue(4, $doc_id);
            $sql->bindValue(5, $cur_prof_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_cursos_profesor($cur_prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE cursos_profesor SET est=0 WHERE cur_prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cur_prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_cursos2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                cursos_profesor.cur_prof_id,
                cursos_profesor.cur_prof_nom,
                cursos_profesor.tipo_id,
                tipos.tipo_nom,
                cursos_profesor.cur_prof_anno,
                docentes.doc_id,
                docentes.doc_nom,
                docentes.doc_ape

                FROM cursos_profesor
                INNER JOIN docentes on docentes.doc_id = cursos_profesor.doc_id
                INNER JOIN tipos on tipos.tipo_id = cursos_profesor.tipo_id
                WHERE cursos_profesor.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>