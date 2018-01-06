
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('curadoria')?>">Curadoria</a></li>
	  <li class="active">Registrar curadoria</li>  
	</ol>
</div>

<?php if(validation_errors()) : ?>
<div class='row'>
	<div class="alert alert-danger">
		<?php echo validation_errors(); ?>
	</div>
</div>
<?php endif; ?>

<div class='row'>
	<h2>Registro de Curadoria</h2>
</div>
<hr />

<div class="row" style="text-align: center;">
  <div class="col-md-6"><label>Imagem do conjunto de dados</label></div>
  <div class="col-md-6"><label>Imagem candidata</label></div>
</div>

<div class="row" style="text-align: center;">
  <div class="col-md-6">
  	<img width="128"  src="<?php echo base_url('vqa/' . $annotationVqa->filename);?>" />
  </div>
  <div class="col-md-6">
  	<img width="128"  src="<?php echo base_url('imagenet/' . $annotationImagenet->filename);?>" />
  </div>
</div>
<div class="row" style="margin-top: 3%; text-align: center;">
	<label>Pergunta: <?php echo $question->statement; ?></label>
</div>
<div>
	<?=form_open('curadoria/registrar', array('role' => 'form'));?>
		<div class="row" style="text-align: center;">
			<div class="col-md-4 col-md-offset-1">
				<input type="text" class="form-control" id="vqa_answer" value="<?php echo $question->answer; ?>">
			</div>
			<div class="col-md-4 col-md-offset-2">
				<input type="text" class="form-control" id="imagenet_answer"/>
			</div>
		</div>

		<div class="row" style="margin-top: 1%; text-align: center;">
			<div class="col-md-6 col-md-offset-6">
				<button type="submit" class="btn btn-primary button-salvar">Responder</button>
				<button type="submit" class="btn btn-primary button-salvar">Copiar Resposta</button>				
			</div>
		</div>
		<div class="row" style="margin-top: 1%; text-align: center;">
			<div class="col-md-6 col-md-offset-6">
				<button type="submit" class="btn btn-danger button-salvar">Não se aplica a esta imagem</button>		
			</div>
		</div>
		<hr />

		<button type="submit" class="btn btn-primary button-salvar">Pular pergunta</button>
		<button type="submit" class="btn btn-primary button-salvar">Pular imagem</button>
		<button type="button" onclick="javascript:location.href='<?=base_url("index")?>'" class="btn btn-danger">Cancelar</button>
	<?=form_close();?>
</div>