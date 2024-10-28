<?php
    class Producto_profesor extends Conectar{
        public function insert_producto_profesor($prod_prof_nom,$prod_prof_tipo,$prod_prof_anno,$prof_id){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO product_profesor (prod_prof_id, prod_prof_nom, prod_prof_tipo, prod_prof_anno, prof_id, est) 
                                 VALUES (NUll,?,?,?,?,1);";
            
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prod_prof_nom);
            $sql->bindValue(2, $prod_prof_tipo);
            $sql->bindValue(3, $prod_prof_anno);
            $sql->bindValue(4, $prof_id);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_producto_profesor($prod_prof_id,$prod_prof_nom,$prod_prof_tipo,$prod_prof_anno,$prof_id){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE product_profesor
                SET
                    prod_prof_nom = ?,
                    prod_prof_tipo = ?,
                    prod_prof_anno = ?,
                    prof_id = ?
                WHERE
                    prod_prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prod_prof_nom);
            $sql->bindValue(2, $prod_prof_tipo);
            $sql->bindValue(3, $prod_prof_anno);
            $sql->bindValue(4, $prof_id);
            $sql->bindValue(5, $prod_prof_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_producto($prod_prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE product_profesor SET est=0 WHERE prod_prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function proyecto(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM product_profesor WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function productos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                product_profesor.prod_prof_id,
                product_profesor.prod_prof_nom,
                product_profesor.prod_prof_tipo,
                product_profesor.prod_prof_anno,
                profesor.prof_id,
                profesor.prof_nom,
                profesor.prof_apep,
                profesor.prof_apem

                FROM product_profesor
                INNER JOIN profesor on profesor.prof_id = product_profesor.prof_id
                WHERE product_profesor.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function producto_id($prod_prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM product_profesor WHERE est = 1 AND prod_prof_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_productos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM product_profesor";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_productos_profesor($prof_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM product_profesor WHERE prof_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_ponencias_ext($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'PE'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_ponencias_int($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'PI'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_articulos_div($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'AD'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_articulos_cien($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'AC'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_articulos_scopus($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'AS'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_capitulos($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'CL'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_libros($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'LI'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function total_software($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM product_profesor WHERE est = 1  AND prof_id=? AND prod_prof_tipo = 'DS'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>