<?php $errFields = Session::flash('form.errors'); ?>
<?php $data = ($result) ? $result : Session::flash('form.data'); ?>

<div class="content-middle">
	<h3>Meu Cadastro » Recuperar senha</h3>
	<p>Preencha seu e-mail de cadastro para iniciar a recuperação de sua senha.</p>
	<br /><br />
	<?php
	echo $form->create('');
	# username
	echo '<p>' . $form->input('username', array('class' => '','div' => false, 'label' => 'E-mail', 'value' => $data['username']));
	if ($errFields['username']) echo '<span class="input-notification error png_bg">' . $errFields['username'] . '</span></p>';
	
	echo $form->close('Recuperar minha senha', array('type' => 'submit', 'class' => 'button right'));
	echo $html->tag('div',null, array('class' => 'clear'));
	?>
</div>