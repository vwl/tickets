<?php
    require_once( 'setorDB.php' );
    $setor=new Setor();
    //Esta enviando dados
    if (isset($_POST[$setor->dfield])) {
        //Esta fazendo UPDATe
        if (isset($_POST[$setor->pk])&&($_POST[$setor->pk])>0) {
            $setor->updStatement($_POST);
        } else {
            $setor->insStatement($_POST);
            
        }
    }
?>

<div class="row clearfix">
	<div class="col-md-12 column">
		<form role="form" method="post">
			<div class="form-group">
				 <label for="SET_ID">Código</label><input type="text" class="form-control" id="SET_ID" name="SET_ID" disabled>
			</div>
			<div class="form-group">
				 <label for="SET_NOME">Nome</label><input type="text" class="form-control" id="SET_NOME" name="SET_NOME">
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
		    $setor->getData();
		?>
	</tbody>
</table>

<?php 
    if (isset($_GET[$setor->pk])) {
        $setor->getById($_GET[$setor->pk]);
    }
?>