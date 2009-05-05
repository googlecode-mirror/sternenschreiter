<?php
class Contentmodel extends Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $PlayerId	= 0;

    function Contentmodel()
    {
        // Call the Model constructor
        parent::Model();
    }
   /*******************
	* Player ID holen
	*******************/     
    function getContent()
    {
        
        return $this->PlayerId;
    }
   /*******************
	* Config auslesen
	*******************/     
    function getPlayerConfig($entry="all")
    {
    	if($entry=="all")
    	{
    		$sql="SELECT * FORM `".TABLE_PLAYER."` WHERE `player_id`='".$this->getPlayerId()."'";
    	}
    	else
    	{
    		$sql="SELECT *  FORM `".TABLE_PLAYER."` WHERE `config_key`='".$entry."' AND `player_id`='".$this->getPlayerId()."'";	
    	}
    	$query = $this->db->get($sql);
		return $query->result();
    }

	
}

?>