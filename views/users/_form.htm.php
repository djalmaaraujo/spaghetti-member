<?php
echo $form->create('');
# name
echo '<p>' . $form->input('name', array('class' => '','div' => true, 'label' => '<strong>Nome:</strong>', 'value' => $data['name']));
if ($errFields['name']) echo '<span class="input-notification error png_bg">' . $errFields['name'] . '</span></p>';

# username
echo '<p>' . $form->input('username', array('class' => '','div' => true, 'label' => '<strong>Email</strong> (será seu usuário)', 'value' => $data['username']));
if ($errFields['username']) echo '<span class="input-notification error png_bg">' . $errFields['username'] . '</span></p>';

# password
echo '<p>' . $form->input('password', array('class' => '','div' => true, 'label' => '<strong>Senha:</strong>', 'value' => $data['password']));
if ($errFields['password']) echo '<span class="input-notification error png_bg">' . $errFields['password'] . '</span></p>';

# password_confirm
echo '<p>' . $form->input('password_confirm', array('class' => '', 'type' => 'password', 'div' => true, 'label' => '<strong>Confirmação de senha:</strong>', 'value' => $data['password_confirm']));
if ($errFields['password_confirm']) echo '<span class="input-notification error png_bg">' . $errFields['password_confirm'] . '</span></p>';

echo $html->tag('br');

# twitter
echo '<p>' . $form->input('twitter', array('class' => '','div' => true, 'label' => 'Qual seu twitter? Ex: @fulano', 'value' => $data['twitter']));
if ($errFields['twitter']) echo '<span class="input-notification error png_bg">' . $errFields['twitter'] . '</span></p>';

# facebook
echo '<p>' . $form->input('facebook', array('class' => '','div' => true, 'label' => 'Facebook: ', 'value' => $data['facebook']));
if ($errFields['facebook']) echo '<span class="input-notification error png_bg">' . $errFields['facebook'] . '</span></p>';

echo $html->tag('br');

# sex
echo '<p>' . $form->input('sex', array('class' => '','options' => array('M' => 'Masculino', 'F' => 'Feminino'), 'type' => 'select', 'div' => true, 'label' => 'Sexo', 'value' => $data['sex']));
if ($errFields['sex']) echo '<span class="input-notification error png_bg">' . $errFields['sex'] . '</span></p>';

echo $html->tag('br');
echo $html->tag('div',null, array('class' => 'clear'));

# newsletter_agree
echo '<p>' . $form->input('newsletter_agree', array('class' => '','div' => true, 'label' => 'Gostaria de receber informações sobre novos produtos, promoções e vale-compras? ', 'type' => 'select', 'options' => array('n' => 'Não, não gostaria', 'y' => 'Sim, gostaria'), 'value' => ($data['newsletter_agree']) ? $data['newsletter_agree'] : 1));
if ($errFields['newsletter_agree']) echo '<span class="input-notification error png_bg">' . $errFields['newsletter_agree'] . '</span></p>';

echo $html->tag('div',null, array('class' => 'clear'));
echo $form->close('Continuar meu cadastro', array('type' => 'submit', 'class' => 'button right'));
echo $html->tag('div',null, array('class' => 'clear'));