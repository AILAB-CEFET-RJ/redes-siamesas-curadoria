<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('usuarios')?>">Users</a></li>
	  <li class="active">Edit User</li>  
	</ol>
</div>


<?php if(validation_errors() || isset($erro)) : ?>
<div class='row'>
	<div class="alert alert-danger">
		<?php echo validation_errors(); ?>
		<?php if(isset($erro)) : ?>
		<?php echo $erro; ?>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<div class='row'>
	<?=form_open('usuarios/atualizar', array('role' => 'form'));?>
	  <input type="hidden" name="id" value="<?=$u->id?>" />	  
	  <div class="form-group">
	    <label for="exampleInputEmail1">Name</label>
	    <input type="text" class="form-control" id="nome" value="<?=$u->nome?>" name="nome" placeholder="">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">E-mail</label>
	    <input type="email" class="form-control" id="email" name="email" value="<?=$u->email?>" placeholder="email@example.com">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">E-mail Confirmation</label>
	    <input type="email" class="form-control" id="confirme_email" value="<?=$u->email?>" name="confirme_email" placeholder="email@example.com">
	  </div>	  	  
	  <button type="submit" class="btn btn-primary button-salvar">Update User Data</button>  
	  <hr />
	  <?=form_close();?>
	  <?=form_open('usuarios/atualizar_senha', array('role' => 'form'));?>
	  <input type="hidden" name="id" value="<?=$u->id?>" />	  
	  <div class="form-group">
	    <label for="exampleInputEmail1">Current Password</label>
	    <input type="password" class="form-control" id="senha_antiga" name="senha_antiga" placeholder="senha">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">New Senha</label>
	    <input type="password" class="form-control" id="senha" name="senha" placeholder="senha">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">New Password Confirmation</label>
	    <input type="password" class="form-control" id="confirme_senha" name="confirme_senha" placeholder="senha">
	  </div>	  
	  <hr />
	  <button type="submit" class="btn btn-primary button-salvar">Update Password</button>
	  <button type="button" onclick="javascript:location.href='<?=base_url("usuarios/index")?>'" class="btn btn-danger">Cancelar</button>
	  <?=form_close();?>
</div>