<?php $errFields = Session::flash('form.errors'); ?>
<?php $data = ($result) ? $result : Session::flash('form.data'); ?>

<div class="content-middle">
	<h3>Meu Cadastro » Recuperar senha</h3>
	<p>Preencha sua nova senha abaixo e a respectiva confirmação.</p>
	<br /><br />
	<?php
	echo $form->create('');
	
	# password
	echo '<p>' . $form->input('password', array('class' => '','div' => true, 'label' => '<strong>Senha:</strong>', 'value' => $data['password']));
	if ($errFields['password']) echo '<span class="input-notification error png_bg">' . $errFields['password'] . '</span></p>';

	# password_confirm
	echo '<p>' . $form->input('password_confirm', array('class' => '', 'type' => 'password', 'div' => true, 'label' => '<strong>Confirmação de senha:</strong>', 'value' => $data['password_confirm']));
	if ($errFields['password_confirm']) echo '<span class="input-notification error png_bg">' . $errFields['password_confirm'] . '</span></p>';
	
	echo $form->close('Modificar minha senha', array('type' => 'submit', 'class' => 'button right'));
	echo $html->tag('div',null, array('class' => 'clear'));
	?>
</div>