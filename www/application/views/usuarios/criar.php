
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('leitores')?>">Users</a></li>
	  <li class="active">Create User</li>  
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
	<h2>Create User</h2>
	<hr />
	<?=form_open('usuarios/salvar', array('role' => 'form'));?>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Name</label>
	    <input type="text" class="form-control" id="nome" name="nome" placeholder="">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">E-mail</label>
	    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">E-mail confirmation</label>
	    <input type="email" class="form-control" id="confirme_email" name="confirme_email" placeholder="email@example.com">
	  </div>	  
	  <div class="form-group">
	    <label for="exampleInputEmail1">Password</label>
	    <input type="password" class="form-control" id="senha" name="senha" placeholder="senha">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Password confirmation</label>
	    <input type="password" class="form-control" id="confirme_senha" name="confirme_senha" placeholder="senha">
	  </div>	  
	  <hr />
	  <button type="submit" class="btn btn-primary button-salvar">Save</button>
	  <button type="button" onclick="javascript:location.href='<?=base_url("usuarios/index")?>'" class="btn btn-danger">Cancel</button>
	<?=form_close();?>
</div>