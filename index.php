
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tickets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	
</head>

<body>
<div class="container">
	<div id="menu">
	    <?php
            require_once 'menu.php'; 
	        
            @$menu = new Menu($_GET['menu']);
            $menu->menuHeader();
	    ?>
	</div>
	<div id="tela">
        <?php
            if (isset($menu)) $menu->menuBody();
            
        ?>
    </div>
</div>
</body>


    
</html>
