<?php 
require_once 'lib/utils/Mailer.php';
class Users extends AppModel {
	public $table = "users";
	public $order = "id DESC";
	public $searchableFields = array();
	public $cantBeEqualFields = array('username');
	
	public $validates = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório'
		),
		'username' => array(
			'rule' => 'email',
			'message' => 'Precisa ser um e-mail'
		),
		'password' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório'
		),
		'password_confirm' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório'
		)
	);

	/**
	 * AUTH REGISTER
	 */	
	public function registerMailRecoverSend($user_id = null) {
		
		$user = $this->firstById($user_id);
		$user_mail = $user['username'];
		$user_name = $user['name'];
		
		# Mail Token
		$signup_recover_code = $this->generateToken($user);
		
		# Saves token
		$this->save(array(
			'id' => $user['id'],
			'signup_recover_code' => $signup_recover_code,
		));
		
		$user['signup_recover_code'] = $signup_recover_code;
				
		# Send mail
		$mailer = new Mailer(array(
			'from' => array(Config::read("Mailer.smtp.username") => "Sistema"),
			'to' => array($user_mail => $user_name),
			'subject' => Config::read("app.name") . ' - [Recuperar senha]',
			'views' => array(
			'text/plain' => 'users/mail_register_recover.txt',
			'text/html' => 'users/mail_register_recover.htm'
			),
			'data' => array(
							'user' => $user
			)));
			
			if ($mailer->send()):
				return true;
			else:
				return false;
			endif;
	}
	
	public function registerMailSend($user_id = null) {
		
		$user = $this->firstById($user_id);
		$user_mail = $user['username'];
		$user_name = $user['name'];
		
		# Mail Token
		$signup_code = $this->generateToken($user);
		
		# Saves token
		$this->save(array(
			'id' => $user['id'],
			'signup_code' => $signup_code,
			'signup_status' => 0
		));
		
		$user['signup_code'] = $signup_code;
				
		# Send mail
		$mailer = new Mailer(array(
			'from' => array(Config::read("Mailer.smtp.username") => "Sistema"),
			'to' => array($user_mail => $user_name),
			'subject' => Config::read("app.name") . ' - [Ativação de cadastro]',
			'views' => array(
			'text/plain' => 'users/mail_register.txt',
			'text/html' => 'users/mail_register.htm'
			),
			'data' => array(
							'user' => $user
			)));
			
			if ($mailer->send()):
				return true;
			else:
				return false;
			endif;
	}
	
	/**
	 * AUTH REGISTER
	 */ 
	
	public function beforeSave($data)
	{
		$new_data = $this->normalizeData($data);
		return $new_data;
	}
	
	private function normalizeData($data)
	{
		if (!$this->hasPasswordChanges($data)):
			unset($data['password']);
		else:
			$data['password'] = Security::hash($data['password'], Config::write('app.hash'), true);
		endif;
		unset($data['password_confirm']);
		
		return $data;
	}
	
	public function checkPassword($data)
	{
		if ($data['password'] == $data['password_confirm']):
			return true;
		else:
			$this->errors['password'] = 'As senhas devem ser iguais para que possam ser alteradas';
			$this->errors['password_confirm'] = 'As senhas devem ser iguais para que possam ser alteradas';
			return false;
		endif;
	}
	
	public function hasPasswordChanges($data)
	{
		if (!empty($data['password']) || !empty($data['password_confirm'])):
			return true;
		else:
			return false;
		endif;
	}
	
	private function generateToken($user = null)
	{
		$default = date('Y-m-d H:i:s') . date('Y-m-d H:i:s') . rand(rand(1,100),9);
		$content = ($user) ? substr(md5($user['created']), 0, 7) . $default : $default;
		return sha1($content);
	}
	
}