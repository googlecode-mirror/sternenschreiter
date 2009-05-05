<?php

class Cron extends Controller {

	function Cron()
	{
		parent::Controller();
		$this->load->helper('GeneralFunc');
		$this->load->model('cronmodel', 'cronmodel');

	}
// Index Contoller
	function index()
	{
		echo"<pre>";
		print_r($this->cronmodel->getCron());
		echo "</pre>done";
		$this->cronmodel->updateCron(1);
	}

}

/* End of file game.php */
/* Location: ./system/application/controllers/game.php */