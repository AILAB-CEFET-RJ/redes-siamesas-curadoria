
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=site_url('home')?>">Home</a></li>
	  <li><a href="<?=site_url('usuarios')?>">Users</a></li>
	  <li class="active">Delete User</li>  
	</ol>
</div>

<div class='row'>
	<h3>Delete User</h3>	
</div>

<hr />

<div class='row'>
	<div class="form-group">
    	<label for="nome">Name</label>
    	<span><?=$u->nome?></span>
  	</div>
  	<div class="form-group">
    	<label for="nome">E-Mail</label>
    	<span><?=$u->email?></span>
  	</div>
  	<div class="form-group">
    	<label for="nome">Last Login</label>
    	<span><?=$u->data_ultimo_login?></span>
  	</div>
  	
  	<a href="<?=site_url("usuarios/apagar/" . $u->id);?>" type="submit" class="btn btn-danger button-delete">Delete</a>
    <a href="<?=site_url("usuarios/index")?>" type="button" class="btn btn-primary button-listar">Back to List</a>
	
</div>