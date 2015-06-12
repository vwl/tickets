<?php
    require_once( 'db.php' ); 
    
    class Login extends persistent {
        public $table = "USUARIO";

        public function getByEmail($email) {
            $result = $this->db->query("
                SELECT
                    USU_ID,
                    USU_NOME,
                    USU_EMAIL,
                    USU_ADMIN
                FROM
                    ".$this->table."
                WHERE
                    USU_EMAIL='{$email}' 
            ");
            if ($result->num_rows==0) {
                header("location:login.php?invalido=1");     
            }
            while($row = mysqli_fetch_array($result)) {
                if (strtolower($row["USU_EMAIL"])==strtolower($email)) {
                    @session_destroy();
                    session_start();
                    $_SESSION["USU_NOME"]=$row["USU_NOME"];
                    $_SESSION["USU_ID"]=$row["USU_ID"];
                    $_SESSION["USU_ADMIN"]=$row["USU_ADMIN"];
                    header("location:index.php");
                }
            }
        }
    }
    
    $login = new Login();
    $login->getByEmail($_POST['email']);
?>