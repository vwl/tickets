<?php
    require_once( 'usuarioDB.php' );
    $usuario=new Usuario();
    //Esta enviando dados
    if (isset($_POST[$usuario->dfield])) {
        //Esta fazendo UPDATe
        if (isset($_POST[$usuario->pk])&&($_POST[$usuario->pk])>0) {
            $usuario->updStatement($_POST);
        } else {
            $usuario->insStatement($_POST);
            
        }
    }
?>

<div class="row clearfix">
	<div class="col-md-12 column">
		<form role="form" method="post">
			<div class="form-group">
				 <label for="USU_ID">Código</label><input type="text" class="form-control" id="USU_ID" name="USU_ID">
			</div>
			<div class="form-group">
				 <label for="USU_NOME">Nome</label><input type="text" class="form-control" id="USU_NOME" name="USU_NOME">
			</div>
			<div class="form-group">
				 <label for="USU_SETOR">Setor</label>
				 <?php
				    $usuario->comboSetor();
				 ?>
			</div>
			<div class="form-group">
				 <label for="USU_EMAIL">Email</label><input type="text" class="form-control" id="USU_EMAIL" name="USU_EMAIL">
			</div>
			<div class="checkbox">
				 <label><input type="checkbox" name="USU_ADMIN" ID="USU_ADMIN" onclick="$('#USU_ADMIN').val($('#USU_ADMIN').prop('checked')===true ? 1 : 0)">Administrador</label>
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
			<th>
				Setor
			</th>
			<th>
				Email
			</th>
			<th>
				Administrador
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		    $usuario->getData();
		?>
	</tbody>
</table>

<?php 
    if (isset($_GET[$usuario->pk])) {
        $usuario->getById($_GET[$usuario->pk]);
    }
?>

<script language="javascript">
    $('#USU_ADMIN').prop('checked',$('#USU_ADMIN').val()==1 ? true : false)
</script>