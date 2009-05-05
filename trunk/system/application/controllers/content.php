<?php

class Content extends Controller {

	function Content()
	{
		parent::Controller();
		//$this->load->helper('GeneralFunc');
		$this->load->library('parser');
		$this->load->model('playermodel', 'playermodel');
		$this->load->model('buildingmodel', 'buildingmodel');
		$this->load->model('planetmodel', 'planetmodel');
		$this->load->helper('generalfunc');
		$this->load->helper('form');

	}
// Index Contoller
	function index()
	{
		if ( !$this->cl_auth->isValidUser() ) {

		redirect('./auth/login', 'location', 301);
		}
		else
		{
			$id=$this->input->get_post('id',true);
			$data=$this->getContent($id);
			$this->parser->parse('content',$data);
		}

	}
	function getContent($id)
	{
		switch($id)
		{
			case '0':
				$isPlayer=$this->playermodel->getPlayerConfig('PLAYER_NAME');
				$ou= $isPlayer['player_value'];
				$ret=outputArray('Willkommen bei Weltenraum',$this->cl_auth->getUsername().'::'.$ou);
			break;
			case '1':
				$playerid=$this->playermodel->getPlayerId($this->cl_auth->getUserID());
				$data=array(
					'NAME'=>$this->cl_auth->getUsername(),
					'PLAYERID'=>$playerid,
					'SCORE'=>$this->playermodel->getPlayerScore(),
					'CREDITS'=>$this->playermodel->getPlayerCredit(),
					'PLANETS'=>$this->parser->parse('planetslist',$this->planetmodel->getPlayerPlanets($playerid,0),true)
				);
				$content=$this->parser->parse('dashboard',$data,true);

				$ret=outputArray($content,'<a href="10002" class="command">Generate user</a>');
			break;
			case '2':

				$playerid=$this->playermodel->getPlayerId($this->cl_auth->getUserID());
				$planets=$this->planetmodel->getPlayerPlanets($playerid,0);
				$ret=outputArray('<h3>Planeten</h3><br />'.print_r($planets,true),'<a href="10001" class="command">Generate map</a>');
			break;
			case '3':
				$ret=outputArray('Forschung','Keine weiteren Infos');
			break;
			case '4':
				$ret=outputArray('Flotte','Keine weiteren Infos');
			break;
			case '5':

				$planetid=$this->playermodel->getPlayerPlanetId($this->cl_auth->getUserID());

				$playerid=$this->playermodel->getPlayerId($this->cl_auth->getUserID());

				$buildinglist=$this->buildingmodel->getPlayerBuildings($playerid,$planetid);
			//log_message('debug',print_r($buildinglist,true));
				$out='';
				$bid='';
				$bidold='';
				$player_building_level=1;
				foreach($buildinglist as $row)
				{
					$bid=$row['building_id'];
					if($bidold=='')$bidold=$bid;
					$table[$bid]['BUILDING_ID']=$row['building_id'];
					$table[$bid][$row['building_key']]=$row['building_value'];
				}

				foreach($table as $row)
				{

						$data=array('TITLE'=>$row['BUILDING_NAME'],
									'LEVEL'=>$player_building_level,
									'VALUE_1'=>number_format( $row['BUILDING_RES_1'],0,',','.'),
									'VALUE_2'=>$row['BUILDING_RES_2'],
									'VALUE_3'=>$row['BUILDING_RES_3'],
									'ACTION'=>outputCMD('5.1',''.$row['BUILDING_ID'],'[bauen]')
									);
						$out.=$this->parser->parse('building_line',$data,true);


				}
				$data=array(
					'TITLE'=>'<h3>Geb&auml;ude</h3>',
					'CONTENT'=>$out
				);
				$ret=outputArray($this->parser->parse('building',$data,true),'<strong>Edit</strong><br />'.outputCMD('10005.2','???','Neues Geb&auml;ude'));
			break;
			case '5.1':
				$ret=outputArray('Baue BID:'.$this->input->get_post('cmd',true),'Keine weiteren Infos');
			break;
			case '5.2':
			break;
			case 6:
				$ret=outputArray('Werft',outputCMD('6.1','??','clickmich'));
			break;
			case '6.1':
				$ret=outputArray('Werft',''.$this->input->get_post('cmd',true));
			break;
			//-Admin CMDs
			case '10001':
				$this->planetmodel->generateMap(100);
				$ret=outputArray('Done','Keine weiteren Infos');
			break;
			case '10002':
				$ret=outputArray('TEST',$this->playermodel->makePlayerConfig());
			break;
			case '10005.2':
				$myform='';
				$ret='';
				$buildingdef=$this->buildingmodel->getBuildingsDef();
				foreach($buildingdef as $entry)
				{
					$data = array(
		              'name'        => $entry['building_key'],
		              'id'          => $entry['building_key'],
		              'value'       => $entry['building_value'],
		              'maxlength'   => '100',
		              'size'        => '50',
		              'style'       => 'width:50%'
		            );

		            $myform.=form_label($entry['building_key'],$entry['building_key']).form_input($data)."<br />";
				}
	            $data = array(
				    'name' => 'Eintragen',
				    'id' => 'button',
				    'value' => 'true',
				    'type' => 'submit',
				    'content' => 'Eintragen'
				);

				$myform.=form_button($data);
				$form=array(
				'TITEL'=>'Neues Geb&auml;ude',
				'FORM'=>$myform,
				'ACTION'=>form_open('content/')

				);
				$ret= outputArray($this->parser->parse('form.php',$form,true),'');
			break;
			/****************/
			default:
				$ret=outputArray('Willkommen bei Weltenraum','Keine weiteren Infos');
			break;
		}
		return $ret;
	}


}

/* End of file game.php */
/* Location: ./system/application/controllers/game.php */