
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icons/color_swatch.png');?>">
	  <?php $segmento = strtolower($this->uri->segment(1)); ?>
    <title>Curadoria de Imagens :: <?php echo $segmento?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/icons/color_swatch.png');?>" />

    <link href="<?php echo base_url('assets/css/jquery-ui.min.css');?>" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/template.css');?>" rel="stylesheet">

    <!-- JQuery core JS -->
    <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js');?>"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand site-id" href="<?php echo base_url();?>">
            <img  class="site-logo" src="<?php echo base_url('assets/img/icons/color_swatch.png');?>" width="28" alt="logo invest" title="Invest" />
            <span class="site-name">Curadoria de Imagens</span>
          </a>
        </div>
        <?php if(isset($usuario)) : ?>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">            
            <li class="<?php echo  $segmento == "annotations" ? "active" : "" ?>"><a href="<?php echo base_url('annotations');?>">Anotações</a></li>
            <li class="<?php echo  $segmento == "synsets" ? "active" : "" ?>"><a href="<?php echo base_url('synsets');?>">Synsets</a></li>
            <li class="<?php echo  $segmento == "curadoria" ? "active" : "" ?>"><a href="<?php echo base_url('curadoria');?>">Curadoria</a></li>
          <?php if($usuario->admin == 1) { ?>
            <li class="<?php echo  $segmento == "usuarios" ? "active" : "" ?>"><a href="<?php echo base_url('usuarios');?>">Usu&aacute;rios</a></li>
          <?php } ?>            
          </ul>          
          <ul class="nav navbar-nav navbar-right">
            <li class="saudacao">Ol&aacute;, <?php echo $usuario->nome;?></li>          
            <li class="active"><a href="<?php echo base_url("logout");?>">Sair</a></li>
          </ul>                  
        </div><!--/.nav-collapse -->  
        <?php endif; ?>         
      </div>      
    </div>
    <div class="container">    	