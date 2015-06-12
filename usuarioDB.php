<?php
    require_once( 'db.php' );
    
    class Usuario extends persistent {
        public $pk = "USU_ID";
        public $dfield = "USU_NOME";
        public $table = "USUARIO";
        
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
            $page="index.php?menu="."Usuário"."&".$this->pk."=";
            $this->db->result2trow($result,$page,$this->pk);
        }
        
        public function insStatement($param) {
            $stmt = $this->db->getStatement("
                INSERT INTO ".$this->table."
                    (USU_NOME,USU_SETOR,USU_EMAIL,USU_ADMIN)
                VALUES 
                    (?,?,?,?)
            ");
            if (!isset($param["USU_ADMIN"])) $param["USU_ADMIN"]=0;

             $stmt->bind_param('sisi', 
                $param["USU_NOME"],
                $param["USU_SETOR"],
                $param["USU_EMAIL"],
                $param["USU_ADMIN"]);
                printf($stmt->error);
           
            $stmt->execute();
            $stmt->insert_id;
            $stmt->close();
        }
        
        public function updStatement($param) {
            $stmt = $this->db->getStatement("
                UPDATE ".$this->table." SET 
                USU_NOME = ?,
                USU_SETOR = ?,
                USU_EMAIL = ?,
                USU_ADMIN = ?
                WHERE ".$this->pk." = ?");
                
            $stmt->bind_param('sisii',
                $param["USU_NOME"],
                $param["USU_SETOR"],
                $param["USU_EMAIL"],
                $param["USU_ADMIN"],
                $param[$this->pk]);
            $stmt->execute();
            $stmt->close();
        }
    }
?>