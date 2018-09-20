
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?=site_url('home')?>">Home</a></li>
	  <li class="active">Tutorial</li>  
	</ol>
</div>


<div class="row">
  <div class="col-sm-12 col-md-12">
 
    <h2>Ao se autenticar no sistema, será apresentada a seguinte tela</h2>

    <hr />
    
    <div class="row">
        <img src="<?=base_url('assets/img/answers/initial.png')?>" class="img-responsive" />
    </div>
    
    <div class="row">

    <p>Nesta tela temos as seguintes informações</p>

    <ol>
        <li>A Imagem a ser curada</li>
        <li>A pergunta relativa a imagem</li>
        <li>O botão com a Resposta "Yes" -> caso a reposta da pergunta seja positiva </li>
        <li>O botão com a Resposta "No" -> caso a reposta da pergunta seja negativa</li>
        <li>O botão com a Resposta "Does Not Apply" -> Caso a pergunta esteja fora de contexto com a imagem </li>
    </ol>

    </div>

    <div class="row">
    <p>Com base nas respostas da curadoria, iremos treinar uma rede neural para conseguir responder a novas perguntas para novas imagens.

    Abaixo seguem exemplos de perguntas e respostas.</p>
    </div>

    <hr />

    <div class="row">
    <h3>1 - Resposta Positiva, nesse caso a resposta da pergunta com base na imagem é positiva</h3>
    <img src="<?=base_url('assets/img/answers/yes.png')?>" class="img-responsive" />
    </div>

    <hr />

    <div class="row">
    <h3>2 - Resposta Negativa, nesse caso a resposta da pergunta com base na imagem é negativa</h3>
    <img src="<?=base_url('assets/img/answers/no.png')?>" class="img-responsive" />
    </div>

    <hr />

    <div class="row">
    <h3>3 - Não se aplica, nesse caso a pergunta esta fora de contexto com a imagem</h3>
    <p>
        É importante dar esse tipo de resposta ao invés de reponder "não" para evitar que o treinamento da rede fique com tendencioso a responder "Não" (viés estatístico)
    </p>
    <img src="<?=base_url('assets/img/answers/does_not_apply.png')?>" class="img-responsive" />
    </div>
</div>

</div>

<hr />

<div class="row"> 
  <p><a class="btn btn-primary btn-lg" role="button" href="<?=site_url('curadoria')?>">Ir para Curadoria</a></p>
</div>