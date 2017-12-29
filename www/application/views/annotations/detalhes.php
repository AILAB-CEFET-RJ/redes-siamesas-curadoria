<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('annotations')?>">Anotações</a></li>
	  <li class="active">Detalhes</li>  
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
	<h2>Detalhes da Imagem</h2>
	<hr />
	<div class="form-group">
	    <label for="nome">IMG_ID:</label>
	    <span><?=$annotation->img_id?></span>
	  </div>
	  <div class="form-group">
	    <label for="nome">WNID</label>
	    <span><?=$annotation->wnid?></span>
	  </div> 
      <div class="form-group">
	    <label for="nome">Atributos :</label>
	    <span><?=$annotation->attrs?></span>
	  </div> 

      <div class="form-group" style="width:40%">
	    <label for="nome">Caixas Delimitadoras (Bounding Boxes)</label>
	    
        <table class="table">            
            <tbody>
                <tr>
                    <td>x1</td>
                    <td><?php echo $bound_box['x1']?></td>
                </tr>
                <tr>
                    <td>x2</td>
                    <td><?php echo $bound_box['x2']?></td>
                </tr>
                <tr>
                    <td>y1</td>
                    <td><?php echo $bound_box['y1']?></td>
                </tr>
                <tr>
                    <td>y2</td>
                    <td><?php echo $bound_box['y2']?></td>
                </tr>
            </tbody>
        </table>

	  </div> 


      <div class="form-group">	    
      <img src="<?php echo base_url('imagenet/' . $annotation->filename);?>"
	  </div> 
</div>
<hr />
<a href="<?=base_url("annotations/index")?>" type="button" class="btn btn-primary button-listar">Voltar para Lista</a>