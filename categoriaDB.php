<?php
    require_once( 'db.php' ); 
    
    class Categoria extends persistent {
        public $pk = "CAT_ID";
        public $dfield = "CAT_NOME";
        public $table = "CATEGORIA";
        
        public function getById($id) {
            $result = $this->db->query("
                SELECT
                    *
                FROM
                    ".$this->table."
                WHERE
                    ".$this->pk."={$id}
            ");
            $this->db->result2input($result);
        }
        
        public function getData() {
             $result = $this->db->query("
                SELECT
                    *
                FROM
                    ".$this->table."
            ");
            $page="index.php?menu="."Categoria"."&".$this->pk."=";
            $this->db->result2trow($result,$page,$this->pk);
        }
        
        public function insStatement($param) {
            $stmt = $this->db->getStatement("
                INSERT INTO ".$this->table."
                    (CAT_NOME)
                VALUES 
                    (?)
            ");
             $stmt->bind_param('s', 
                $param["CAT_NOME"]);
                
            $stmt->execute();
            $stmt->insert_id;
            $stmt->close();
        }
        
        public function updStatement($param) {
            $stmt = $this->db->getStatement("
                UPDATE ".$this->table." SET 
                CAT_NOME = ?
                WHERE ".$this->pk." = ?");
                
            $stmt->bind_param('si',
                $param["CAT_NOME"],
                $param[$this->pk]);
            $stmt->execute();
            $stmt->close();
        }
    }
?>