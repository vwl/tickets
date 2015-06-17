<?php
    require_once( 'ticketDB.php' );
    $ticket=new Ticket();
    function isRequisicao() {
        
        return (($_GET['menu']=="Requisições") ? 1 : 0);
    }
    function getPageDesc() {
        if (isRequisicao()) {
            return "requisição";
        } else {
            return "solicitação";
        }
    }
    function getAlert() {
        echo '<div class="row clearfix">';
            echo '<div class="col-md-12 column">';
                echo '<div class="alert alert-dismissable alert-danger">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                    echo '<h4>';
                        echo 'Atenção!';
                    echo '</h4>'; 
                    echo "Você só pode possuir uma ".getPageDesc()." com prioridade alta";
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    
    
    //Esta enviando dados
    
    if (isset($_POST[$ticket->dfield])) {
        //Esta fazendo UPDATE
        
        if (isset($_POST[$ticket->pk])&&($_POST[$ticket->pk])>0) {
            if (($_POST['TIC_PRIORIDADE']==3)&&($ticket->getByUser($_SESSION['USU_ID'],isRequisicao(),$_POST["TIC_ID"])>0)) {
                getAlert();
            } else {
                $ticket->updStatement($_POST);
            }
        } else {
            if (($_POST['TIC_PRIORIDADE']==3)&&($ticket->getByUser($_SESSION['USU_ID'],isRequisicao(),0)>0)) {
                getAlert();
            } else {
                $ticket->insStatement($_POST);
            }
            
        }
    }
?>

<div class="row clearfix">
	<div class="col-md-12 column">
		<form role="form" method="post">
		    <input type="hidden" id="TIC_REQUISICAO" name="TIC_REQUISICAO" value="<?php echo isRequisicao(); ?>">
		    <input type="hidden" id="TIC_USUARIO" name="TIC_USUARIO" value="<?php echo $_SESSION['USU_ID']; ?>">
		    
			<div class="form-group">
				 <label for="TIC_ID">Código</label><input type="text" class="form-control" id="TIC_ID" name="TIC_ID" readonly>
			</div>
			<div class="form-group">
				 <label for="TIC_ASSUNTO">Assunto</label><input type="text" class="form-control" id="TIC_ASSUNTO" name="TIC_ASSUNTO">
			</div>
			<div class="form-group">
				 <label for="TIC_CATEGORIA">Categoria</label>
				 <?php
				    $ticket->comboCategoria(); 
				 ?>
			</div>
			<div class="form-group">
				 <label for="TIC_PRIORIDADE">Prioridade</label>
				 <?php
				    $ticket->comboPrioridade(); 
				 ?>
			</div>
			<div class="form-group" >
				 <label for="TIC_STATUS">Status</label>
				 <?php
				    $ticket->comboStatus(); 
				 ?>
			</div>
			<div class="form-group">
				 <label for="TIC_DESCRICAO">Descrição</label>
				 <textarea class="form-control" name="TIC_DESCRICAO" id="TIC_DESCRICAO"></textarea>
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
				Setor
			</th>
			<th>
				Usuário
			</th>
			<th>
				Assunto
			</th>
			<th>
				Prioridade
			</th>
			<th>
				Status
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		    $ticket->getData(isRequisicao());
		?>
	</tbody>
</table>

<?php 
    if (isset($_GET[$ticket->pk])) {
        $ticket->getById($_GET[$ticket->pk]);
    }
    
    if ($_SESSION['USU_ADMIN']==0) {
?>
    <script language="javascript">
        if ($("#TIC_ID").val()=="") {
            $("#TIC_STATUS").val("2");
        }
        $("#TIC_STATUS").attr("readonly","true");
    </script>
<?php
    }
?>