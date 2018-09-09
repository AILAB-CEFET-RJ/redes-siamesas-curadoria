<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=site_url('home')?>">Home</a></li>
	  <li><a href="<?=site_url('annotations')?>">Image Annotattions</a></li>
	  <li class="active">Details</li>  
	</ol>
</div>


<div class='row'>
	<h2>Image Details [<?=$annotation->dataset_source?>]</h2>
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
	    <label for="nome">Atributtes :</label>
	    <span><?=$annotation->attrs?></span>
	  </div> 

	  <div class="form-group">
	    <label for="nome">Dataset Source :</label>
	    <span><?=$annotation->dataset_source?></span>
	  </div> 

	  <div class="form-group">
	    <label for="nome">MD5 :</label>
	    <span><?=$annotation->md5?></span>
	  </div> 

      <div class="form-group" style="width:40%">
	    <label for="nome">Bounding Boxes</label>
	    
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
      <img src="<?php echo site_url('dataset/' . $annotation->dataset_source . '/' . $annotation->filename);?>"
	  </div> 
</div>
<hr />
<a href="<?=site_url("annotations/index")?>" type="button" class="btn btn-primary button-listar">Back to List</a>