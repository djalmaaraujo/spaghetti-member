<?php $errFields = Session::flash('form.errors'); ?>
<?php $data = ($result) ? $result : Session::flash('form.data'); ?>

<div class="content-middle">
	<h3>Meu Cadastro</h3>
	<p>Para ser um cliente (pessoa Física ou Jurídica), é necessário preencher corretamente o formulário abaixo com os respectivos dados cadastrais.<br />
	Atenção: os campos em <strong>NEGRITO</strong> são de preenchimento obrigatório e essenciais para processarmos o envio do seu futuro pedido.</p>
	<br /><br />
	<?php echo $this->element('users/form', array('errFields' => $errFields, 'data' => $data)); ?>
</div>