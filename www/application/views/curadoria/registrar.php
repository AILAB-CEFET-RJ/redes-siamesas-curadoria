
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
	<hr />
	
	<label>Imagem do conjunto de dados</label>
	<img width="128"  src="<?php echo base_url('vqa/' . $img_match->annotation_vqa->filename);?>" />
	
	<label>Imagem candidata</label>
	<img width="128"  src="<?php echo base_url('imagenet/' . $img_match->annotation_imagenet->filename);?>" />


	<?=form_open('curadoria/registrar', array('role' => 'form'));?>
	  <!--<div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Confirme o e-mail</label>
	    <input type="email" class="form-control" id="confirme_email" name="confirme_email" placeholder="email@example.com">
	  </div>-->
	  <hr />
	  <button type="submit" class="btn btn-primary button-salvar">Salvar</button>
	  <button type="button" onclick="javascript:location.href='<?=base_url("index")?>'" class="btn btn-danger">Cancelar</button>
	<?=form_close();?>
</div>