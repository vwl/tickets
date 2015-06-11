<?php
    
    class Db {
        
        
        private $mysql; //=mysqli_connect("localhost","root","mar@","mybd");
        function __construct() {
            $this->mysql=mysqli_connect("localhost","root","db@senha@mar123","testephp") or die ('Unable To Connect');
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
                    echo "document.getElementById('".strtolower($key)."').value='{$value}';\n";
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
    
   
    
    
?>