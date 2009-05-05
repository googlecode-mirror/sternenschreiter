<?php

class Menu extends Controller {

	function Menu()
	{
		parent::Controller();
		$this->load->helper('GeneralFunc');
		$this->load->library('parser');

	}
// Index Contoller
	function index()
	{
			$menudata=$this->mymenu();
			$this->parser->parse('menu',$menudata);
	}

/*
* Menu Function
*/
	function mymenu()
	{
		$homeurl='';//site_url('game/index/id').'/';
		$data[]=Array(
		'link'=>$homeurl.'1',
		'ad'=>' title="Übersicht"',
		'title'=>'Dashboard'
		);
		$data[]=Array(
		'link'=>$homeurl.'2',
		'ad'=>' title="Planeten"',
		'title'=>'Planeten'
		);
		$data[]=Array(
		'link'=>$homeurl.'3',
		'ad'=>' title="Forschung"',
		'title'=>'Forschung'
		);
		$data[]=Array(
		'link'=>$homeurl.'4',
		'ad'=>' title="Flotte"',
		'title'=>'Flotte'
		);
		$data[]=Array(
		'link'=>$homeurl.'5',
		'ad'=>' title="Gebäude"',
		'title'=>'Geb&auml;ude'
		);
		$data[]=Array(
		'link'=>$homeurl.'6',
		'ad'=>' title="Werft"',
		'title'=>'Werft'
		);
		$output='';
		foreach($data as $row)
		{
			$link=$row['link'];
			$ad=$row['ad'];
			$title=$row['title'];
			$output.=sprintf('<li><a href="%s" %s>%s</a></li>',$link,$ad,$title);
		}
		$menudata=array('MENU'=>$output);


		return $menudata;
	}

}

/* End of file menu.php */
/* Location: ./system/application/controllers/game.php */