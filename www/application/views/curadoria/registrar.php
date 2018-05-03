
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=base_url('home')?>">Home</a></li>
	  <li><a href="<?=base_url('curadoria')?>">Curation</a></li>
	  <li class="active">Register Annotation</li>  
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
	<h2>Curation</h2>
</div>
<hr />

<div class="row" style="text-align: center;">
  <div class="col-md-6"><label>Original dataset Image</label></div>
  <div class="col-md-6"><label>Candidate dataset Image</label></div>
</div>

<div class="row" style="text-align: center;">
  <div class="col-md-6">
  	<img width="299"  src="<?php echo base_url('dataset/vqa/' . $annotationVqa->filename);?>" />
  </div>
  <div class="col-md-6">
  	<img width="299"  src="<?php echo base_url('dataset/imagenet/' . $annotationImagenet->filename);?>" />
  </div>
</div>
<div class="row" style="margin-top: 3%; text-align: center;">
	<label>Question: <?php echo $question->statement; ?></label>
</div>
<div style="margin-top: 3%;">
	<?=form_open('curadoria/register_match_question', array('role' => 'form'));?>
		<div class="row" style="text-align: center;">
			<div class="col-md-4 col-md-offset-1">
				<input type="text" readonly class="form-control" id="vqa_answer" value="<?php echo $question->answer?>">
			</div>
			<div class="col-md-2 col-md-offset-2">
				<input type="text" class="form-control" id="imagenet_answer" name="imagenet_answer" value="<?php echo $question->answer ?>" />
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-primary" id="btnToggleAnswer">Swap Answer</button>
			</div>
		</div>

		<div class="row" style="margin-top: 1%; text-align: center;">
			<div class="col-md-6 col-md-offset-6">
				<button type="submit" class="btn btn-primary button-salvar">Response</button>
			</div>
		</div>
		<div class="row" style="margin-top: 1%; text-align: center;">
			<div class="col-md-6 col-md-offset-6">
				<button type="button" id="btn_no_match" class="btn btn-danger button-salvar">Does not apply to this image</button>		
			</div>
		</div>
		<hr />

		<input type="hidden" name="question_id" value="<?php echo $question->id; ?>" />
		<input type="hidden" name="annotation_imagenet_id" value="<?php echo $annotationImagenet->img_id; ?>" />
		<input type="hidden" name="annotation_vqa_id" value="<?php echo $annotationVqa->img_id; ?>" />
		<button type="button" class="btn btn-primary" onclick="javascript:location.href='<?=base_url("curadoria/change_question/$annotationVqa->img_id/$annotationImagenet->img_id/$question->id")?>'">Skip question</button>
		<button type="button" class="btn btn-primary" onclick="javascript:location.href='<?=base_url("curadoria")?>'">Skip image</button>
		<button type="button" class="btn btn-danger" onclick="javascript:location.href='<?=base_url("annotations")?>'">Cancel</button>
	<?=form_close();?>
</div>

<script type="text/javascript">
	$('document').ready(function(){

		$('#btnToggleAnswer').click(function(){
			$('#imagenet_answer').val($('#imagenet_answer').val() == 'Sim' ? 'Não' : 'Sim');
		});

		$('#btn_no_match').click(function(e){
			$('form').attr('action', '<?php echo base_url('curadoria/register_no_match_question')?>');
			$('form').submit();
		});

	});
</script>
