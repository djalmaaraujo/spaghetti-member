<?php 

class UsersController extends AppController {

	public function index() {
	}


	public function login() {}


	public function logout() {
		$this->AuthComponent->logout();
	}


	public function account() {
	}
	
	/**
	 * AUTH REGISTER
	 */
	public function register() {
		if ($this->data):
			if ($this->Users->validate($this->data)):
				
				$hasEqualInformations = $this->Users->hasEqualInformations($this->data);
				if (!$hasEqualInformations):
					$this->Users->save($this->data);
					$this->Users->registerMailSend($this->Users->id);
					Session::writeFlash('adm.alert', array('success', 'Você completou a primeira etapa de seu cadastro. Para continuar, siga as instruções abaixo:'));
					$this->redirect('/users/register_instructions/?mail=' . $this->data['username']);
				else:
					$this->Users->errors = $hasEqualInformations;
					return $this->getErrorsAndReturn();
				endif;
			else:
				return $this->getErrorsAndReturn();
			endif;
		endif;
	}
	
	public function register_activation($token = null)
	{
		$this->autoRender = false;
		$signup_code = end(explode('/', $this->params['here']));
		if ($user = $this->Users->firstBySignupCode($signup_code)):
			if ($user['signup_status'] == 0):
				$this->Users->save(array(
					'id' => $user['id'],
					'signup_status' => 1,
					'signup_code' => NULL
				));
				Session::writeFlash('adm.alert', array('success', 'Parabéns! Seu cadastro foi ativado com sucesso!'));
			endif;
			$this->redirect('/');
			
		else:
			Session::writeFlash('adm.alert', array('success', 'Código inválido, seu código de ativação pode ter expirado.'));
			$this->redirect('/users/register_actiction_resend');
		endif;
	}
	
	public function register_recover_activation($token = null)
	{
		$signup_recover_code = end(explode('/', $this->params['here']));
		if ($user = $this->Users->first(array('conditions' => array('signup_recover_code' => $signup_recover_code)))):
			if ($this->data):
				if (!empty($this->data['password']) && !empty($this->data['password_confirm']) && ($this->data['password'] == $this->data['password_confirm'])):
					$this->Users->save(array(
						'id' => $user['id'],
						'password' => $this->data['password'],
						'signup_recover_code' => NULL
					));
					Session::writeFlash('adm.alert', array('success', 'Sucesso! sua senha foi alterada com sucesso! Efetue seu login novamente.'));
					$this->redirect('/users/login?form=show');
				else:
					$this->Users->errors = array(
						'password' => 'As senhas precisam ser iguais',
						'password_confirm' => 'As senhas precisam ser iguais'
					);
					return $this->getErrorsAndReturn();
				endif;
			else:
				Session::writeFlash('adm.alert', array('information', 'Modifique sua senha abaixo'));
			endif;
						
		else:
			Session::writeFlash('adm.alert', array('error', 'Código inválido, seu código de ativação pode ter expirado.'));
			$this->redirect('/');
		endif;
	}
	
	public function register_recover()
	{
		if ($this->data):
			if ($user = $this->Users->firstByUsername($this->data['username'])):
				Session::writeFlash('adm.alert', array('success', 'Um e-mail com as instruções para você recuperar sua senha foi enviado para sua caixa de entrada.'));
				$this->Users->registerMailRecoverSend($user['id']);
				$this->redirect('/');
			else:
				Session::writeFlash('adm.alert', array('error', 'Usuário não encontrado, tente novamente.'));
			endif;
		endif;
	}
	/**
	 * AUTH REGISTER
	 */
	
	private function getErrorsAndReturn($message = null, $model = 'Users')
	{
		$message = (!$message) ? 'Atenção para os erros encontrados no formulário de preenchimento' : $message;
		Session::writeFlash('form.errors', $this->{$model}->errors);
		Session::writeFlash('form.data', $this->data);
		Session::writeFlash('adm.alert', array('warning', $message));
	}
}