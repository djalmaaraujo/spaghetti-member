<p>Olá <strong><?php echo $user['name']; ?></strong>, você se cadastrou no nosso website!</p>
	<p>Para ativar seu cadastro, acesse o link abaixo:</p>
	
	<p style="font-size:30px"><?php echo Config::read('app.url_base'); ?>users/register_activation/<?php echo $user['signup_code']; ?></p>
	
	<p>--</p>
	<p>O <?php echo Config::read('app.name'); ?> não envia e-mail solicitando suas informações pessoais. Caso você receba algum e-mail com este assunto, denuncie imediatamente.</p>
<p>
	------------------------------------------------------------------------------------------<br />
	<strong><?php echo Config::read('app.name'); ?></strong><br />
	<strong><?php echo Config::read('app.url_base'); ?></strong><br />
	------------------------------------------------------------------------------------------<br /><br />
	<sub>E-mail enviado em <em><?php echo date('d/m/Y H:i:s'); ?></em></sub>
</p>