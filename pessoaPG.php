<?php
    require_once( 'pessoaDB.php' );
    $pessoa=new Pessoa();
    
    //Esta enviando dados
    if (isset($_POST['ps_nome'])) {
        //Esta fazendo UPDATe
        if (isset($_POST['ps_cod'])&&($_POST['ps_cod'])>0) {
            $pessoa->updStatement($_POST);
        } else {
            $pessoa->insStatement($_POST);
        }
    }
?>

<div class="row clearfix">
	<div class="col-md-12 column">
		<form role="form" method="post">
			<div class="form-group">
				 <label for="ps_cod">Código</label><input type="text" class="form-control" id="ps_cod" name="ps_cod">
			</div>
			<div class="form-group">
				 <label for="ps_nome">Nome</label><input type="text" class="form-control" id="ps_nome" name="ps_nome">
			</div>
			<div class="checkbox">
				 <label><input type="checkbox">Administrador</label>
			</div> <button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>
<table class="table table-condensed table-hover editavel">
	<thead>
		<tr>
			<th>
				#
			</th>
			<th>
				Nome
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		    $pessoa->getData();
		?>
	</tbody>
</table>

<?php 
   
    
    if (isset($_GET['ps_cod'])) {
        $pessoa->getById($_GET['ps_cod']);
    }
?>