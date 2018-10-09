
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('curadoria')?>">Curation</a></li>
	  <li class="active">Register Annotation</li>  
	</ol>
</div>

<div class="row" style="text-align: center;">
  <div class="col-sm-12 col-md-6">
		<h4>Candidate Image</h4>
		<img width="399" height="399"  src="<?php echo base_url('dataset/imagenet/' . $annotationImagenet->filename);?>" />
	</div>
	
	<div class="col-sm-12 col-md-6">
		<h1 style="margin-bottom:15%"><?php echo $question->statement?></h1>
		<?=form_open('curadoria/register_match_question', array('role' => 'form', "id" => "formAnswer"));?>		  
			<a href="#" type="button" id="btnYes" class="btn btn btn-success btn-block" style="margin-bottom:5%;padding-top:20px;padding-bottom:20px;font-size:24px">Yes</a>
			<a href="#" type="button" id="btnNo" class="btn btn btn-danger btn-block" style="margin-bottom:5%;padding-top:20px;padding-bottom:20px;font-size:24px">No</a>
			<a href="#" type="button" id="btnSkipQuestion" class="btn btn btn-default btn-block" style="padding-top:20px;padding-bottom:20px;font-size:24px" onclick="javascript:location.href='<?=site_url("curadoria/register_no_match_question/$question->img_id/$annotationImagenet->img_id/$question->id")?>'" />Does not apply to this image</a>
						
			<input type="hidden" name="question_id" value="<?php echo $question->id; ?>" />
			<input type="hidden" name="annotation_imagenet_id" value="<?php echo $annotationImagenet->img_id; ?>" />
			<input type="hidden" name="annotation_vqa_id" value="<?php echo $question->img_id; ?>" />
			<input type="hidden" name="imagenet_answer" id="imagenet_answer" value="<?php echo $question->img_id; ?>" />
		
		<?=form_close();?>

	</div>
	
</div>

<script type="text/javascript">
	$('document').ready(function(){
		$('#btnYes').click(function(){
			$('#imagenet_answer').val("yes");
			$('#formAnswer').submit();
		});		

		$('#btnNo').click(function(){
			$('#imagenet_answer').val("no");
			$('#formAnswer').submit();
		});				

	});
</script>
