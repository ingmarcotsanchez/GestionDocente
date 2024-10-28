<?php
    class Docente extends Conectar{
        public function insert_docentes($doc_image, $doc_dni, $doc_nom,$doc_ape,$doc_correo,$doc_correo2,$doc_niv,$doc_sex,$doc_telf,$esc_id,$doc_fecini,$doc_fecfin,$doc_cvlac,$doc_orcid,$doc_google,$doc_est,$prog_id,$mod_id){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO docentes (doc_id,doc_image,doc_dni,doc_nom,doc_ape,doc_correo,doc_correo2,doc_niv,doc_sex,doc_telf,esc_id,doc_fecini,doc_fecfin,doc_cvlac,doc_orcid,doc_google,doc_est,prog_id, mod_id,fech_crea, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_image);
            $sql->bindValue(2, $doc_dni);
            $sql->bindValue(3, $doc_nom);
            $sql->bindValue(4, $doc_ape);
            $sql->bindValue(5, $doc_correo);
            $sql->bindValue(6, $doc_correo2);
            $sql->bindValue(7, $doc_niv);
            $sql->bindValue(8, $doc_sex);
            $sql->bindValue(9, $doc_telf);
            $sql->bindValue(10, $esc_id);
            $sql->bindValue(11, $doc_fecini);
            $sql->bindValue(12, $doc_fecfin);
            $sql->bindValue(13, $doc_cvlac);
            $sql->bindValue(14, $doc_orcid);
            $sql->bindValue(15, $doc_google);
            $sql->bindValue(16, $doc_est);
            $sql->bindValue(17, $prog_id);
            $sql->bindValue(18, $mod_id);
             
           // $sql->bindValue(18, $prof_cv);
            $sql->execute();
            $sql1="SELECT last_insert_id() as 'doc_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
            //return $resultado = $sql->fetchAll();
        }

        public function update_docentes($doc_id,$doc_image, $doc_dni, $doc_nom,$doc_ape,$doc_correo,$doc_correo2,$doc_niv,$doc_sex,$doc_telf,$esc_id,$doc_fecini,$doc_fecfin,$doc_cvlac,$doc_orcid,$doc_google,$doc_est,$prog_id,$mod_id){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE docentes
                SET
                    doc_image = ?,
                    doc_dni = ?,
                    doc_nom = ?,
                    doc_ape = ?,
                    doc_correo = ?,
                    doc_correo2 = ?,
                    doc_niv = ?,
                    doc_sex = ?,
                    doc_telf = ?,
                    esc_id = ?,
                    doc_fecini = ?,
                    doc_fecfin = ?,
                    doc_cvlac = ?,
                    doc_orcid = ?,
                    doc_google = ?,
                    doc_est = ?,
                    prog_id = ?,
                    mod_id = ?
                WHERE
                    doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_image);
            $sql->bindValue(2, $doc_dni);
            $sql->bindValue(3, $doc_nom);
            $sql->bindValue(4, $doc_ape);
            $sql->bindValue(5, $doc_correo);
            $sql->bindValue(6, $doc_correo2);
            $sql->bindValue(7, $doc_niv);
            $sql->bindValue(8, $doc_sex);
            $sql->bindValue(9, $doc_telf);
            $sql->bindValue(10, $esc_id);
            $sql->bindValue(11, $doc_fecini);
            $sql->bindValue(12, $doc_fecfin);
            $sql->bindValue(13, $doc_cvlac);
            $sql->bindValue(14, $doc_orcid);
            $sql->bindValue(15, $doc_google);
            $sql->bindValue(16, $doc_est);
            $sql->bindValue(17, $prog_id);
            $sql->bindValue(18, $mod_id);
            $sql->bindValue(19, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_docentes($doc_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE docentes SET est=0 WHERE doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function docentes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM docentes";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        

        public function docentes2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                docentes.doc_id,
                docentes.doc_image,
                docentes.doc_dni,
                docentes.doc_nom,
                docentes.doc_ape,
                docentes.doc_correo,
                docentes.doc_correo2,
                docentes.doc_niv,
                docentes.doc_sex,
                docentes.doc_telf,
                docentes.esc_id,
                escalafon.esc_nombre,
                docentes.doc_fecini,
                docentes.doc_fecfin,
                docentes.doc_cvlac,
                docentes.doc_orcid,
                docentes.doc_google,
                docentes.doc_est,
                programas.prog_id,
                programas.prog_nom,
                modalidades.mod_id,
                modalidades.mod_nom
                FROM docentes
                INNER JOIN escalafon on docentes.esc_id = escalafon.esc_id
                INNER JOIN modalidades on docentes.mod_id = modalidades.mod_id
                INNER JOIN programas on docentes.prog_id = programas.prog_id
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_profesorDetallexid($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                docentes.doc_id,
                docentes.doc_image,
                docentes.doc_dni,
                docentes.doc_nom,
                docentes.doc_ape,
                docentes.doc_correo,
                docentes.doc_correo2,
                docentes.doc_niv,
                docentes.doc_sex,
                docentes.doc_telf,
                escalafon.esc_id,
                escalafon.esc_nombre,
                docentes.doc_fecini,
                docentes.doc_fecfin,
                docentes.doc_cvlac,
                docentes.doc_orcid,
                docentes.doc_google,
                docentes.doc_est,
                programas.prog_id,
                programas.prog_nom,
                modalidades.mod_id,
                modalidades.mod_nom
                FROM docentes
                INNER JOIN escalafon on docentes.esc_id = escalafon.esc_id
                INNER JOIN modalidades on docentes.mod_id = modalidades.mod_id
                INNER JOIN programas on docentes.prog_id = programas.prog_id
                WHERE docentes.doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function docentes_id($doc_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM docentes WHERE est = 1 AND doc_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_profesores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM docentes WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estadoActivo($doc_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE docentes SET doc_est=1, est=1 WHERE doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($doc_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE docentes SET doc_est=0, est=0 WHERE doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
       
    }
?>