<?php
class Buildingmodel extends Model {

    var $building_table;
    var $building_table_def;
    var $player_building_table;


    function Buildingmodel()
    {
        // Call the Model constructor
        parent::Model();
        $this->building_table=$this->config->item('TABLE_BUILDING');
        $this->building_table_def=$this->config->item('TABLE_BUILDING_DEF');
        $this->player_building_table=$this->config->item('TABLE_PLAYER_BUILDING');
    }
   /*******************
	* Player ID holen
	*******************/

   /*******************
	* Config auslesen
	*******************/
    function getBuildingConfig($buildingID=0,$entry="all")
    {
    	switch(true)
	    {
	    	case($buildingID!=0 && $entry=="all"):// Get all keys for one Building

	    		$sql="SELECT * FROM `".$this->building_table."` WHERE `building_id`='%' AND `building_id`='".$buildingID."' ORDER BY `building_id`";

	    	break;
	    	case ($buildingID!=0 && $entry!="all")://Get only one key for one Building
	    		$sql="SELECT *  FROM `".$this->building_table."` WHERE `building_config_key`='".$entry."' AND `building_id`='".$buildingID."'";
	    	break;
	    	case ($buildingID=0 && $entry="all"):// Get all keys and all buildings
	    		$sql="SELECT *  FROM `".$this->building_table."` WHERE `building_config_key`='%' ORDER BY `building_id`";
	    	break;
	    	case ($buildingID=0 && $entry!="all"): // For all Buildings the same KEY
	    		$sql="SELECT *  FROM `".$this->building_table."` WHERE `building_config_key`='".$entry."' ORDER BY `building_id`";
	    	break;
	    	default:
	    		$sql="SELECT *  FROM `".$this->building_table."` ORDER BY `building_id`";//Get whole Table
	    	break;
    	}
    	$query = $this->db->query($sql);
		$ret=$query->result_array();
		return ($ret)?$ret:array('building_config_value'=>0);

    }
   /*******************
	* Neuen Wert in Config schreiben
	*******************/
	function insertConfig()
    {

    }
   /*******************
	* Wert in Config aktualisieren
	*******************/
    function updateConfig()
    {
		$sql="SELECT pb.`building_level`, b.`building_id`, b.`building_key`,b.`building_value` FROM `wr_player_building` as pb, `wr_building` as b WHERE pb.`player_id`='".$PlayerID."' and pb.`planet_id`='".$PlanetID."' and pb.`building_id`=b.`building_id`";
		$query = $this->db->query($sql);
		$ret=$query->result_array();
		return ($ret)?$ret:array('building_config_value'=>0);

	}
	function makePlayerBuildings()
	{
		$sql = "SELECT `building_id`,`building_value` FROM `".$this->building_table."` WHERE `building_key` LIKE 'STARTERLEVEL' AND `building_value` !='0'  ";
		$query = $this->db->query($sql);
		$buildings=$query->result_array();
		foreach($buildings as $building)
			$this->insertPlayerBuilding($this->playermodel->getPlayerID(),$this->playermodel->getPlayerPlanetId(),$building['building_id'],$building['building_value']);
		return true;
	}
	function insertPlayerBuilding($player_id,$planet_id,$building_id,$building_level)
	{
		$sql="INSERT INTO `".$this->player_building_table."` (`id`,`player_id`,`planet_id`,`building_id`,`building_level`) VALUES('','$player_id','$planet_id','$building_id','$building_level')";
		$query = $this->db->query($sql);
		return true;
	}
	function getPlayerBuildings($player_id,$planet_id,$whole=true)
	{
		if($whole)
		{
			$sql = "SELECT * FROM `".$this->player_building_table."` as pb, `".$this->building_table."` as b WHERE `player_id` = '".$player_id."' AND `planet_id` = '".$planet_id."' and pb.`building_id`=b.`building_id` ";
		}
		else
		{
			$sql = "SELECT * FROM `".$this->player_building_table."` WHERE `player_id` = '".$player_id."' AND `planet_id` = '".$planet_id."'  ";
		}
		$query = $this->db->query($sql);
		$ret=$query->result_array();
		return $ret;
	}
	function getBuildingsDef()
	{

		$sql = "SELECT * FROM `".$this->building_table_def."` as pb ";
		$query = $this->db->query($sql);
		$ret=$query->result_array();
		return $ret;
	}
}