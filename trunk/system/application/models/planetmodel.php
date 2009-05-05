<?php
class Planetmodel extends Model {

    var $planet_table;


    function Planetmodel()
    {
        // Call the Model constructor
        parent::Model();
        $this->planet_table=$this->config->item('TABLE_PLANET');
        $this->player_planet_table=$this->config->item('TABLE_PLAYER_PLANET');
    }



	/*****************/
	function getPlayerPlanets($PlayerID=0,$PlanetID=0)
	{
		switch (true)
		{
			case($PlayerID==0&&$PlanetID==0):
				$sql="SELECT * FROM ".$this->planet_table."  ";
			break;
			case($PlayerID!=0&&$PlanetID==0):
				$sql="SELECT pp.*,p.* FROM ".$this->player_planet_table." as pp,".$this->planet_table." as p  WHERE pp.`player_id`='".$PlayerID."' and pp.`planets_id`=p.`planets_id`";
			break;
			case($PlayerID!=0&&$PlanetID!=0):
				$sql="SELECT pp.*,p.* FROM ".$this->player_planet_table." as pp,".$this->planet_table." as p  WHERE p.`player_id`='".$PlayerID."' and pp.`planets_id`=p.`planets_id` and p.`planets_id`='".$PlanetID."' ";
			break;
			default:
				$sql="SELECT * FROM ".$this->planet_table."  ";
			break;
		}

		$query = $this->db->query($sql);
		$ret=$query->result_array();
		return ($ret);

	}
	function makePlayerPlanet()
	{
		$ret=true;
		$sql="SELECT * FROM ".$this->planet_table."  WHERE `planets_state`='0' LIMIT 1";

		$query = $this->db->query($sql);
		$planets=$query->result_array();

		$planets_id=$planets[0]['planets_id'];
		$player_id=$this->playermodel->getPlayerID();
		$sql="UPDATE ".$this->planet_table." SET `planets_state`=1 WHERE `planets_id`='".$planets_id."'";
		$query = $this->db->query($sql);
		$sql="INSERT ".$this->player_planet_table." (`id`,`player_id`,`planets_id`,`planets_status`) VALUES('','".$player_id."','".$planets_id."','1')";
		$query = $this->db->query($sql);
		$this->playermodel->insertConfig($this->cl_auth->getUserID(),$player_id,'PLAYER_PLANET',$planets_id,'1');
		return $ret;
	}

	function getPlanetMap($PlayerID)
	{
		return $this->getPlayerPlanets();
	}
	function generateMap($count)
	{
		$planetcount=0;
		$planetarray=array();
		$planets=array();
		while($planetcount<$count)
		{
			$x=rand(1,200)-100;
			$y=rand(1,200)-100;
			if(!isset($planetarray["$x"]["$y"]))
			{
				$planetarray["$x"]["$y"]=1;
				$planets[]=array('x'=>$x,'y'=>$y);
				$planetcount++;
			}
		}

		foreach($planets as $planet)
		{
		$planetarray=array(
		'name'=>'unbekannt',
		'x'=>$planet['x'],
		'y'=>$planet['y'],
		'z'=>1,
		'type'=>1,
		'state'=>0
		);
		$this->insertPlanet($planetarray);
		}
	}
	function insertPlanet($PlanetArray)
	{
		$sql="INSERT INTO `wr_planets` (
		`id` ,
		`planets_id` ,
		`planets_name` ,
		`planets_x` ,
		`planets_y` ,
		`planets_z` ,
		`planets_type` ,
		`planets_state`
		)
		VALUES (
			NULL , UUID(), '".$PlanetArray['name']."' , '".$PlanetArray['x']."', '".$PlanetArray['y']."' , '".$PlanetArray['z']."', '".$PlanetArray['type']."', '".$PlanetArray['state']."'
		);";
		$query = $this->db->query($sql);
	}
	function getPlanet($PlanetID='0')
	{
	switch (true)
		{
			case($PlanetID!='0')&&($PlanetID!='-1'):
				$sql="SELECT * FROM ".$this->planet_table."  WHERE `planets_id`='".$PlanetID."'";
			break;
			case($PlanetID=='-1'):
				$sql="SELECT * FROM ".$this->planet_table."  WHERE `planets_state`='0' LIMIT 1";
			break;
			default:
				$sql="SELECT * FROM ".$this->planet_table."  ";
			break;
		}

		$query = $this->db->query($sql);
		$ret=$query->result_array();
		return $ret;
	}
}