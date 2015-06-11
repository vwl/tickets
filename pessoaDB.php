<?php
    require_once( 'db.php' );
    
    class Pessoa extends persistent {
        public $pk = "ps_cod";
        
        public function getById($id) {
            $result = $this->db->query("
                SELECT
                    *
                FROM
                    pessoa
                WHERE
                    ps_cod={$id}
            ");
            $this->db->result2input($result);
        }
        
        public function getData() {
             $result = $this->db->query("
                SELECT
                    *
                FROM
                    pessoa
            ");
            $page="pessoa.php?ps_cod=";
            $this->db->result2trow($result,$page,$this->pk);
        }
        
        public function insStatement($param) {
            $stmt = $this->db->getStatement("
                INSERT INTO pessoa
                    (ps_nome)
                VALUES 
                    (?)
            ");
            //$param["ps_nome"]="benicio";
            $stmt->bind_param('s', 
                $param["ps_nome"]);
            $stmt->execute();
            echo $stmt->insert_id;
            $stmt->close();
        }
        
        public function updStatement($param) {
            $stmt = $this->db->getStatement("
                UPDATE pessoa SET 
                ps_nome = ?
                WHERE ps_cod = ?");
            
            //$param["ps_nome"]="venico";
            //$param["ps_cod"]=2;
            $stmt->bind_param('si',
                $param['ps_nome'],
                $param['ps_cod']);
            echo $stmt->execute();
            $stmt->close();
        }
    }
?>