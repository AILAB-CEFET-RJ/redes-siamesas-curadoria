<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=site_url('home')?>">Home</a></li>
	  <li class="active">Synsets</li>  
	</ol>
</div>

<div class='row'>
	<?=form_open('synsets/resultado_busca', array('role' => 'form', 'class' => 'form-inline', 'method' => 'get'));?>
	  <div class="form-group">	   
	    <input type="search" class="form-control campo-busca" id="q" value="<?=$q?>" placeholder="digite uma palavra-chave ou wnid" name="q">	  	
	  </div>
	  <button type="submit" class="btn btn-default button-pesquisar">Pesquisar</button> 
    <br />
	<?=form_close();?>

</div>

<br />

<?php if(isset($total_rows) && (!isset($q) || empty($q))) : ?>
<div class="row">
     Foram encontrados <strong><?php echo $total_rows; ?></strong> synstes com imagens associadas.
</div>
<?php endif; ?>


<?php if(isset($q) && !empty($q)) : ?>
<div class="row">
     Foram encontrados <strong><?php echo $total_rows; ?></strong> resultado(s) encontrados para "<em><?php echo $q; ?></em>"
</div>
<?php endif; ?>

<?php if(isset($erro) && !empty($erro)) : ?>
<div class="row">
	<div class="alert alert-danger text-center" role="alert"><?php echo $erro;?></div>
</div>
<?php endif; ?>

<div class="row">
<table class="table table-striped">
      <thead>
        <tr>
          <th>wnid</th>
          <th>Palavras-Chave</th>
          <th>Quantidade de Imagens</th>
        </tr>
      </thead>
      <tbody>      	
      	<?php foreach($synsets as $synset): ?>
        <tr>          
          <td>
          	<a href="<?php echo site_url("synsets/detalhes") . "/" . $synset->wnid;?>">
          		<?php echo trim($synset->wnid); ?>
          	</a>          		
          </td>  
           <td>
              <?php echo trim($synset->words); ?>
          </td> 
           <td class="text-center">
           <a href="<?php echo site_url("synsets/detalhes") . "/" . $synset->wnid;?>">
          		<?php echo trim($synset->qtde); ?>
          	</a>             
          </td>     
        </tr>            
        <?php endforeach; ?>   
      </tbody>
    </table>
 </div>

<div class="row text-center">
	<?php echo $paginacao; ?>
</div>