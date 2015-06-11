<?php
    class Menu {
        function menuHeader($atual) {
            echo '<div class="row clearfix">';
    		echo '<div class="col-md-12 column">';
    		    echo '<nav class="navbar navbar-default" role="navigation">';
        			echo '<div class="navbar-header">';
        					 echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">Tickets</a>';
        			echo '</div>';
        				
        			echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
        			    echo '<ul class="nav navbar-nav">';
        			        $itensMenu =  Array("Indicentes","Requisições","Categoria","Setor","Usuários");
        			        foreach ($itensMenu as $value) {
    			                if ($value==$atual) {
    			                    echo '<li class="active">';
    			                } else {
    			                    echo '<li>';
    			                }
        					        echo '<a href="#">'.$value.'</a>';
        			            echo '</li>';
        			        }
        				echo '</ul>';
        				echo '<ul class="nav navbar-nav navbar-right">';
        						echo '<li>';
        							echo '<a href="#">Usuário</a>';
        						echo '</li>';
                        echo '</ul>';
                    echo '</div>';
    		    echo '</nav>';
    	    echo '</div>';
            echo '</div>';
        }
    }
?>