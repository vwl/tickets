<?php
    require_once( 'categoriaDB.php' );
    $categoria=new Categoria();
    //Esta enviando dados
    if (isset($_POST[$categoria->dfield])) {
        //Esta fazendo UPDATe
        if (isset($_POST[$categoria->pk])&&($_POST[$categoria->pk])>0) {
            $categoria->updStatement($_POST);
        } else {
            $categoria->insStatement($_POST);
            
        }
    }
?>

<div class="row clearfix">
	<div class="col-md-12 column">
		<form role="form" method="post">
			<div class="form-group">
				 <label for="CAT_ID">Código</label><input type="text" class="form-control" id="CAT_ID" name="CAT_ID" disabled>
			</div>
			<div class="form-group">
				 <label for="CAT_NOME">Nome</label><input type="text" class="form-control" id="CAT_NOME" name="CAT_NOME">
			</div>
			<button type="submit" class="btn btn-default">Salvar</button>
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
		    $categoria->getData();
		?>
	</tbody>
</table>

<?php 
    if (isset($_GET[$categoria->pk])) {
        $categoria->getById($_GET[$categoria->pk]);
    }
?>