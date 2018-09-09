<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=site_url('home')?>">Home</a></li>
	  <li><a href="<?=site_url('synsets')?>">Synsets</a></li>
	  <li class="active">Detalhes</li>  
	</ol>
</div>


<div class='row'>
	<h2>Detalhes do Synset</h2>
	<hr />

	<div class="form-group">
	    <label for="nome">WNID:</label>
	    <span><?=$synset->wnid?></span>
	</div>

	<div class="form-group">
	    <label for="nome">Palavras-Chave:</label>
	    <span><?=$synset->words?></span>
	 </div>
	
	<?php if(isset($qtde_imagens) && !empty($qtde_imagens)) : ?>
	 <div class="form-group">
	    <label for="nome">Quantidade de Imagens:</label>
	    <span><?=$qtde_imagens?></span>
	 </div>
	<?php endif; ?>

	<?php if(isset($annotations) && !empty($annotations)) : ?>

		
	<strong>Exemplos de imagens do synset.</strong><br /><br />
		
			<table class="table">
				<tr>
				<?php $i=1; ?>
				<?php foreach($annotations as $annotation): ?>

					<td>
						<a href="<?php echo site_url("annotations/details") . "/" . $annotation->img_id;?>">
							<img width="128" heigth="128" src="<?php echo base_url('dataset/' . $annotation->dataset_source . '/' . $annotation->filename);?>" />
						</a>
					</td>

					<?php if($i % 5 == 0) : ?>
						</tr><tr>
					<?php endif; ?>

					<?php $i++; ?>

				<?php endforeach ?>

				</tr>

			</table>
	 <hr />
	<?php endif; ?>
</div>



<a href="javascript:history.back();" type="button" class="btn btn-primary button-listar">Voltar para Lista</a>