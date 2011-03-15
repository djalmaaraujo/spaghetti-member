<div class="content-middle">
    <h3>Cadastro / Autenticação</h3>

		<p>Se você possui uma conta na nossa loja ou esta é sua primeira compra, você vai precisar autenticar sua sessão. Caso você já tenha conhecimento de suas informações, utilize o quadro abaixo de autenticação. Se vocie ainda não é nosso usuário, clique para iniciar seu registro agora mesmo!</p>
    
		<br />

 		<div class="box-login-register">
		  <h3> Cadastre-se e compre </h3>
		  <p> Cique abaixo para fazer seu cadastro e poder finalizar suas compras</p>
		   <a href="/users/register" class="button">Cadastre-se aqui</a>
		 </div>


		<div class="box-login-register">
        <h3> Faça seu login </h3>
        <div class="login-info" style="display: <?php echo ($this->params['named']['form'] == 'show') ? 'none' : 'block'; ?>">
        	<p> Clique abaixo para fazer seu login e poder continuar comprando.</p>
	       	<a href="/users/login?form=show" class="button">Fazer login</a>
        </div>
				<div class="login-form" style="display: <?php echo ($this->params['named']['form'] == 'show') ? 'block' : 'none'; ?>">
					<?php echo $form->create('/users/login'); ?>
					<?php echo $form->input('username', array('placeholder' => 'Login', 'label' => false)); ?>
					<?php echo $form->input('password', array('placeholder' => 'senha', 'label' => false)); ?>
					<?php echo $form->close('Continuar', array('class' => 'button', 'type' => 'submit')); ?>
					<a href="/users/register_recover"><u>Esqueceu sua senha?</u></a>
				</div>
				
    </div>
		<div class="clear"></div>
		
</div>