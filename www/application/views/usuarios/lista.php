<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=site_url('home')?>">Home</a></li>
	  <li class="active">Users</li>  
	</ol>
</div>

<div class='row'>
	<?=form_open('usuarios/resultado_busca', array('role' => 'form', 'class' => 'form-inline', 'method' => 'get'));?>
	  <div class="form-group" class="col-sm-8">   
	    <input type="search" class="form-control campo-busca" id="q" value="<?=$q?>" placeholder="digite o nome ou o email" name="q">	  	
	  </div>
	  <button type="submit" class="btn btn-default button-pesquisar">Search</button>
	  <button type="button" class="btn btn-success button-adicionar" onclick="location.href='<?=site_url('usuarios/criar')?>'">Add User</button>
	<?=form_close();?>
</div>

<br />

<div class="row">

<img src="<?php echo base_url("assets/img/icons/user_gray.png"); ?>" /> = <em>admin</em>
<hr />
<table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th class="hidden-sm hidden-xs">Admin</th>
          <th>Name</th>
          <th class="hidden-sm hidden-xs">E-mail</th>
          <th class="hidden-sm hidden-xs">Last Login</th>
          <th class="hidden-sm hidden-xs">Last Login</th>
          <?php if($usuario->admin == 1) : ?>
          <th class="text-right">Pares curados</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>      	
      	<?php foreach($usuarios as $u): ?>
        <tr>        
          <td><?php echo $u->id; ?></td>
          <td class="hidden-sm hidden-xs">
           <?php if($u->admin == 1){ ?>
               <img src="<?php echo base_url("assets/img/icons/user_gray.png"); ?>" />
            <?php } else { ?>
                --
            <?php } ?>
          </td>
          <td>
          	<a href="<?php echo site_url("usuarios/editar") . "/" . $u->id;?>">          	
            	<?php echo $u->nome; ?>             
          	</a>          		
          </td>
          <td class="hidden-sm hidden-xs"><?php echo $u->email; ?></td>
          <td class="hidden-sm hidden-xs"><?php echo $u->data_ultimo_login; ?></td>
          <td class="hidden-sm hidden-xs">
          	<?php if($usuario->id != $u->id) : ?>
                <a href="<?php echo site_url("usuarios/excluir") . "/" . $u->id;?>" title="Excluir" class="btn btn-default button-delete">Apagar</a>            
            <?php endif; ?>
          </td>
          <?php if($usuario->admin == 1): ?>
          <td class="text-right"><?php echo $u->pares_curados();?></td>
          <?php endif;?>
        </tr>            
        <?php endforeach; ?>   
      </tbody>
    </table>
 </div>


<?php echo $paginacao; ?>
