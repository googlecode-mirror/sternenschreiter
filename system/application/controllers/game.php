<?php

class Game extends Controller {

	function Game()
	{
		parent::Controller();

		$this->load->helper('GeneralFunc');
		$this->load->library('parser');
		$this->load->model('playermodel', 'playermodel');
		$this->load->model('planetmodel', 'planetmodel');
		$this->load->model('buildingmodel', 'buildingmodel');
	}
// Index Contoller
	function index()
	{
		if ( !$this->cl_auth->isValidUser() ) {

		redirect('./auth/login', 'location', 301);
		}
		elseif(!$this->isPlayer())
		{
			$this->makePlayer();
			$data=array(
			'CONTENT'=>'Willkommen zu Weltenraum '.$this->cl_auth->getUsername()
			);
			$this->parser->parse('game',$data);
		}
		else
		{
			$data=array(
			'CONTENT'=>'Willkommen zu Weltenraum '.$this->cl_auth->getUsername()
			);
			$this->parser->parse('game',$data);
		}
	}
// Player Funcs
	function isPlayer()
	{
		$isPlayer=$this->playermodel->getPlayerConfig('PLAYER_NAME');
		return ($isPlayer['player_value']!='0')?true:false;
	}
	function makePlayer()
	{
		$this->playermodel->makePlayerConfig();
		$this->planetmodel->makePlayerPlanet();
		//log_message('debug',__LINE__.__FILE__."TEST");
		$this->buildingmodel->makePlayerBuildings();
		return true;
	}
	function killPlayer()
	{

	}
}

/* End of file game.php */
/* Location: ./system/application/controllers/game.php */