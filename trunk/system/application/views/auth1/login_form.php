<?php

$this->load->view($this->config->item('CL_header'));

$form = $this->validation;

$username = array(
'name'	=> 'username',
'id'	=> 'username',
'maxlength'	=> $this->config->item('CL_login_maxlength'),
'size'	=> 30,
'value' => isset($form->username) ? $form->username : '');

$password = array(
'name'	=> 'password',
'id'	=> 'password',
'maxlength'	=> $this->config->item('CL_password_max'),
'size'	=> 30);

$remember = array(
'name'	=> 'remember',
'id'	=> 'remember',
'value'	=> true,
'checked'	=> (!empty($form->error_string) ? $form->set_checkbox('remember', true) : true),
'style' => 'margin:0;padding:0');

$confirmation_code = array(
'name'	=> 'captcha_code',
'id'	=> 'captcha_code',
'maxlength'	=> 8);

?>

<fieldset><legend accesskey="D" tabindex="1">Login</legend>
<?php echo form_open($this->uri->uri_string())?>

<?php
if ( $this->cl_auth->user_error ): ?>
<p class="error"><?php echo $this->cl_auth->user_error; ?></p>
<?php
endif;
?>

<dl>
	<!--USERNAME-->
	<dt><?php echo form_label('Username', $username['id']);?></dt>
	<dd><?php echo form_input($username);?>
    <?php echo $form->username_error;?></dd>

    <!--PASSWORD-->
	<dt><?php echo form_label('Password', $password['id']);?></dt>
	<dd><?php echo form_password($password);?>
    <?php echo $form->password_error;?></dd>

<?php
if ($this->config->item('CL_captcha_login') AND $this->cl_auth->captcha == true): ?>
	<dt>Enter the code exactly as it appears. All letters are case insensitive, there is no zero.</dt>
	<dd><?php echo $this->cl_auth->captcha_img;?></dd>

	<dt><?php echo form_label('Confirmation Code', $confirmation_code['id']);?></dt>
	<dd><?php echo form_input($confirmation_code);?>
	<?php echo $form->captcha_code_error;?></dd>
<?php
endif;
?>

	<dt></dt>
	<dd><?php echo form_checkbox($remember);?> <?php echo form_label('Remember?', $remember['id']);?> <?php echo anchor($this->config->item('CL_forgotten_uri'), 'Forgotten?');?> 
<?php
if ($this->config->item('CL_allow_registration')) {
	echo anchor($this->config->item('CL_register_uri'), 'Register');
};
?></dd>

	<dt></dt>
	<dd><?php echo form_submit('login','Login');?></dd>
</dl>

<?php echo form_close()?>
</fieldset>

<?php
$this->load->view($this->config->item('CL_footer'));
?>