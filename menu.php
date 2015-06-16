<?php
    @session_start();
    if (!isset($_SESSION['USU_ID'])) {
        header("location:login.php?invalido=1");
    }
    
    class Menu {
        public $menupagina = Array("Incidentes" => "ticket", "Requisições" => "ticket","Categoria" => "categoria", "Setor" => "setor", "Usuário" => "usuario");
        public $pagina;
        public $arquivo;
        
        function __construct($pagina) {
            $this->pagina=$pagina;
            @$this->arquivo=$this->menupagina[$pagina];
        }
        
        function menuHeader() {
            echo '<div class="row clearfix">';
    		echo '<div class="col-md-12 column">';
    		    echo '<nav class="navbar navbar-default" role="navigation">';
        			echo '<div class="navbar-header">';
        					 echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">Tickets</a>';
        			echo '</div>';
        				
        			echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
        			    echo '<ul class="nav navbar-nav">';
        			        foreach ($this->menupagina as $key => $value) {
        			            if ($_SESSION['USU_ADMIN']==0) {
        			                if ($value!="ticket") continue;
        			            }
    			                if ($key==$this->pagina) {
    			                    echo '<li class="active">';
    			                } else {
    			                    echo '<li>';
    			                }
        					        echo '<a href="index.php?menu='.$key.'">'.$key.'</a>';
        			            echo '</li>';
        			        }
        				echo '</ul>';
        				echo '<ul class="nav navbar-nav navbar-right">';
        						echo '<li>';
        							echo '<a href="login.php">'.$_SESSION['USU_NOME'].'</a>';
        						echo '</li>';
                        echo '</ul>';
                    echo '</div>';
    		    echo '</nav>';
    	    echo '</div>';
            echo '</div>';
        }
        
        function menuBody() {
            if (isset( $this->arquivo)) include $this->arquivo.'PG.php';
        }
    }
?>