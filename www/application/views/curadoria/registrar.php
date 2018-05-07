
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('curadoria')?>">Curation</a></li>
	  <li class="active">Register Annotation</li>  
	</ol>
</div>

<div class="row" style="text-align: center;">
  <div class="col-md-6"><h4>Original dataset Image</h4></div>
  <div class="col-md-6"><h4>Candidate dataset Image</h4></div>
</div>

<div class="row" style="text-align: center;">
  <div class="col-md-6">
  	<img width="350" height="299"  src="<?php echo base_url('dataset/vqa/' . $annotationVqa->filename);?>" />
  </div>
  <div class="col-md-6">
  	<img width="350" height="299"  src="<?php echo base_url('dataset/imagenet/' . $annotationImagenet->filename);?>" />
  </div>
</div>
<div class="row text-center curation-question">
	<h1>Question: <?php echo $question->statement; ?></h1>
	<br />
</div>

<div class="row" style="text-align: center;">
  <?=form_open('curadoria/register_match_question', array('role' => 'form'));?>		  
  <div class="col-md-6">
  	<?php if($question->answer == "yes"): ?>
		<p style="font-size:48px; color:#006600 text-transform: capitalize"><?php echo $question->answer; ?></p>
	<?php else: ?>
		<p style="font-size:48px; color:#660000 text-transform: capitalize"><?php echo $question->answer; ?></p>
	<?php endif;?>
  </div>
  
  <div class="col-md-4 col-md-offset-1">
	<a href="#" type="button" class="btn btn btn-success btn-block">Yes</a>
	<a href="#" type="button" class="btn btn btn-danger btn-block">No</a>
	<a href="#" type="button" class="btn btn btn-default btn-block" onclick="javascript:location.href='<?=base_url("curadoria/register_no_match_question")?>'">Does not apply to this image</a>
  </div>
  
  <input type="hidden" name="question_id" value="<?php echo $question->id; ?>" />
  <input type="hidden" name="annotation_imagenet_id" value="<?php echo $annotationImagenet->img_id; ?>" />
  <input type="hidden" name="annotation_vqa_id" value="<?php echo $annotationVqa->img_id; ?>" />
  
  <?=form_close();?>
</div>

<hr />
<div class="row text-center">	
	<a onclick="javascript:location.href='<?=base_url("curadoria")?>'" type="button" style="width:25%" class="btn btn btn-primary  btn-lg">Skip Image</a>
	<a onclick="javascript:location.href='<?=base_url("curadoria/change_question/$annotationVqa->img_id/$annotationImagenet->img_id/$question->id")?>'" href="<?=base_url("annotations/index")?>" type="button" style="width:25%" class="btn btn btn-primary  btn-lg">Skip Question</a>	
</div>

<script type="text/javascript">
	$('document').ready(function(){
		$('#btnToggleAnswer').click(function(){
			$('#imagenet_answer').val($('#imagenet_answer').val() == 'Sim' ? 'Não' : 'Sim');
		});		
	});
</script>