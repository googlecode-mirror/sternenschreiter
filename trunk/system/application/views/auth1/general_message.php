<?php
$this->load->view($this->config->item('CL_header'));
?>

<p class="message"><?php echo $this->cl_auth->message; ?></p>

<?php
$this->load->view($this->config->item('CL_footer'));
?>