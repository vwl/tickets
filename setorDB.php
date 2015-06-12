<?php
    require_once( 'db.php' ); 
    
    class Setor extends persistent {
        public $pk = "SET_ID";
        public $dfield = "SET_NOME";
        public $table = "SETOR";
        
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
            $page="index.php?menu="."Setor"."&".$this->pk."=";
            $this->db->result2trow($result,$page,$this->pk);
        }
        
        public function insStatement($param) {
            $stmt = $this->db->getStatement("
                INSERT INTO ".$this->table."
                    (SET_NOME)
                VALUES 
                    (?)
            ");
             $stmt->bind_param('s', 
                $param["SET_NOME"]);
                printf($stmt->error);
           
            $stmt->execute();
            $stmt->insert_id;
            $stmt->close();
        }
        
        public function updStatement($param) {
            print_r($param);
            $stmt = $this->db->getStatement("
                UPDATE ".$this->table." SET 
                SET_NOME = ?
                WHERE ".$this->pk." = ?");
                
            $stmt->bind_param('si',
                $param["SET_NOME"],
                $param[$this->pk]);
            $stmt->execute();
            $stmt->close();
        }
    }
?>