<?php
    
    class Db {
        
        
        private $mysql;
        
        function __construct() {
            $this->mysql=mysqli_connect("localhost","root","db@senha@mar123","tickets") or die ('Unable To Connect');
        }
        
        public function query($sqlquery) {
            return $result=$this->mysql->query($sqlquery);
        }
        
        public function getStatement($stmt) {
            return $this->mysql->prepare($stmt);
        }
        
        public function showResult($result) {
            print_r($result);
        }
        
        public function result2input($result) {
            echo "<script language='javascript'>";
            while($row = mysqli_fetch_array($result)) {
                foreach ($row as $key => $value) {
                    if (is_numeric($key)) continue; //Ignore row index
                    echo "document.getElementById('".($key)."').value='{$value}';\n";
                }
            } 
            echo "</script>";
        }
        
        public function result2trow($result,$page,$pk) {
             while($row = mysqli_fetch_array($result)) {
                if (isset($page)) {
                    echo "<tr onclick=\"document.location = '".$page.$row[strtoupper($pk)]."'\">";
                } 
                foreach ($row as $key => $value) {
                    if (is_numeric($key)) continue; //Ignore row index
                    echo "<td>{$value}</td>";
                }
                echo "</tr>\n";
            } 
        }
        
        public function result2combo($table,$pk,$desc,$field) {
            //($pk==$selected ? "selected" : "" )
		    $result=$this->query("select $pk,$desc from $table");
		    echo '<select class="form-control" id="'.$field.'" name="'.$field.'">';
		    while($row = mysqli_fetch_array($result)) {
		        echo "<option value='".$row[$pk]."'>".$row[$desc]."</option>";
		    }
		    echo '</select>';
        }
    }
    
    class persistent {
        protected $db;
        
        public function __construct() {
            $this->db= new Db();    
        }
        public function __desctruct() {
            $this->db->close();
            unset($this->db);
        }
    }
    
   /*
   
   $field="USU_SETOR";
				    $itens= Array(1 => "Infraestrutura", 2 => "Financeiro");
				    
				    echo '<select class="form-control" id="'.$field.'" name="'.$field.'">';
				        foreach ($itens as $key => $value) {
				            echo "<option value='".$key."'>".$value."</option>";
				        }
				    echo '</select>';*/
    
    
?>