<?php
    require_once( 'db.php' ); 
    
    class Ticket extends persistent {
        public $pk = "TIC_ID";
        public $dfield = "TIC_ASSUNTO";
        public $table = "TICKET";
        
        public function getByUser($user) {
            $result = $this->db->query("
                SELECT
                    TIC_ID
                FROM
                    ".$this->table."
                WHERE
                    TIC_USUARIO=$user
                    AND
                    TIC_PRIORIDADE=3
            ");
            if ($row = mysqli_fetch_array($result)) {
                return $row['TIC_ID'];
            } else {
                return 0;
                //Nenhum registro encontrado
            }
        }
        
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
        
        public function getData($req=0) {
             $result = $this->db->query("
                SELECT
                    TIC_ID,
                    SETOR.SET_NOME,
                    USUARIO.USU_NOME,
                    TIC_ASSUNTO,
                    case TIC_PRIORIDADE when 1 then 'Baixa' when 2 then 'Média' else 'Alta' end as TIC_PRIORIDADE,
                    case TIC_STATUS when 1 then 'Fechado' when 2 then 'Aberto' else 'Processando' end as TIC_STATUS_DESC
                FROM
                    ".$this->table."
                LEFT JOIN USUARIO ON (TICKET.TIC_USUARIO=USUARIO.USU_ID)
                LEFT JOIN SETOR ON (USUARIO.USU_SETOR=SETOR.SET_ID)
                WHERE
                    TIC_REQUISICAO=$req
                    ".($_SESSION['USU_ADMIN']==0 ? "AND TIC_USUARIO=".$_SESSION['USU_ID'] : "" )."
                ORDER BY
                    TIC_STATUS DESC,
                    TIC_PRIORIDADE ASC,
                    TIC_ID ASC
                    
            ");
            if ($req==1) {
                $pagina="Requisições";
            } else {
                $pagina="Incidentes";
            }
            $page="index.php?menu=".$pagina."&".$this->pk."=";
            $this->db->result2trow($result,$page,$this->pk);
        }
        
        public function insStatement($param) {
            $stmt = $this->db->getStatement("
                INSERT INTO ".$this->table."
                    (TIC_ASSUNTO,TIC_REQUISICAO,TIC_DESCRICAO,TIC_PRIORIDADE,TIC_USUARIO,TIC_CATEGORIA,TIC_STATUS)
                VALUES 
                    (?,?,?,?,?,?,?)
            ");
            
             $stmt->bind_param('sisiiii', 
                $param["TIC_ASSUNTO"],
                $param["TIC_REQUISICAO"],
                $param["TIC_DESCRICAO"],
                $param["TIC_PRIORIDADE"],
                $param["TIC_USUARIO"],
                $param["TIC_CATEGORIA"],
                $param["TIC_STATUS"]);
        
            $stmt->execute();
            $stmt->insert_id;
            echo $stmt->error;
            $stmt->close();
        }
        
        public function updStatement($param) {
            $stmt = $this->db->getStatement("
                UPDATE ".$this->table." SET 
                TIC_ASSUNTO = ?,
                TIC_REQUISICAO = ?,
                TIC_DESCRICAO = ?,
                TIC_PRIORIDADE = ?,
                TIC_USUARIO = ?,
                TIC_CATEGORIA = ?,
                TIC_STATUS = ?
                WHERE ".$this->pk." = ?");
                
            $stmt->bind_param('sisiiiii',
                $param["TIC_ASSUNTO"],
                $param["TIC_REQUISICAO"],
                $param["TIC_DESCRICAO"],
                $param["TIC_PRIORIDADE"],
                $param["TIC_USUARIO"],
                $param["TIC_CATEGORIA"],
                $param["TIC_STATUS"],
                $param[$this->pk]);
            $stmt->execute();
            $stmt->close();
        }
        
        public function comboCategoria() {
            $this->db->result2combo("CATEGORIA","CAT_ID","CAT_NOME","TIC_CATEGORIA");
        }
        
        public function comboPrioridade() {
            $itens= Array(1 => "Baixa", 2 => "Média", 3=> "Alta");
            $this->staticCombo("TIC_PRIORIDADE",$itens);
        }
        
        public function comboStatus() {
            //$itens= Array(1 => "Aberto", 2 => "Processando", 3=> "Fechado");
            $itens= Array(1 => "Fechado", 2 => "Aberto", 3=> "Processando");
            $this->staticCombo("TIC_STATUS",$itens);
        }
    }
?>