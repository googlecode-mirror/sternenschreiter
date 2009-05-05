<?php
class Playermodel extends Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $PlayerId	= 0;
    var $player_table;
    var $PlayerScore = 0;
    var $PlayerCredit = 0;
    var $PlayerAlly = 0;

    function Playermodel()
    {
        // Call the Model constructor
        parent::Model();
        $this->player_table=$this->config->item('TABLE_PLAYER');
        $player_score=$this->getPlayerConfig('PLAYER_SCORE');
        $this->PlayerScore=$player_score['player_value'];
        $player_credit=$this->getPlayerConfig('PLAYER_CREDIT');
        $this->PlayerCredit=$player_credit['player_value'];
        $player_ally=$this->getPlayerConfig('PLAYER_ALLY');
        $this->PlayerAlly=$player_ally['player_value'];
    }
   /*******************
	* Player ID holen
	*******************/
    function getPlayerId($userID=0)
    {
    	$ret='';
    	$userID=($userID===0)?$this->cl_auth->getUserID():$userID;
		$sql = sprintf("SELECT `player_id` FROM `"
		.$this->player_table
		."` WHERE `id` = '%s' LIMIT 1"
		,$userID);
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $row)
		{$ret=$row['player_id'];}
        return $ret;
    }
      function getPlayerPlanetId($userID=0)
    {
    	$ret=$this->getPlayerConfig('PLAYER_PLANET');
        return $ret['player_value'];
    }
    function getPlayerScore()
    {
    	return $this->PlayerScore;
    }
    function getPlayerCredit()
    {
    	return $this->PlayerCredit;
    }
    function getPlayerAlly()
    {
    	return $this->PlayerAlly;
    }
   /*******************
	* Config auslesen
	*******************/
    function getPlayerConfig($entry="all")
    {
    	if($entry=="all")
    	{
    		$sql="SELECT * FROM `".$this->player_table."` WHERE `player_id`='".$this->getPlayerId()."'";
    	}
    	else
    	{
    		$sql="SELECT *  FROM `".$this->player_table."` WHERE `player_key`='".$entry."' AND `player_id`='".$this->getPlayerId()."'";
    	}
    	$query = $this->db->query($sql);
		$ret=$query->row_array();
		return ($ret)?$ret:array('player_value'=>0);

    }
    function makePlayerConfig()
    {
		$this->insertConfig($this->cl_auth->getUserID(),'','PLAYER_NAME',$this->cl_auth->getUsername(),'1');
		$player_id=$this->getPlayerID();
		$this->insertConfig($this->cl_auth->getUserID(),$player_id,'PLAYER_SCORE','0','1');
		$this->insertConfig($this->cl_auth->getUserID(),$player_id,'PLAYER_CREDIT','10000','1');
		$this->insertConfig($this->cl_auth->getUserID(),$player_id,'PLAYER_ALLY','0','1');
		$this->insertConfig($this->cl_auth->getUserID(),$player_id,'PLAYER_PLANET','','1');
		return 'nix';
    }
   /*******************
	* Neuen Wert in Config schreiben
	*******************/
	function insertConfig($id,$player_id,$player_key,$player_value,$player_status)
    {
    	$player_id=($player_id!=='')?$player_id="'".$player_id."'":"UUID()";
		$sql="INSERT INTO ".$this->player_table
		." (`id`,`player_id`,`player_key`,`player_value`,`player_status`)"
		."VALUES (".$id.",".$player_id.",'".$player_key."','".$player_value."','".$player_status."')";
		$query = $this->db->query($sql);
		$ret='';
		return $ret;
    }
   /*******************
	* Wert in Config aktualisieren
	*******************/
    function updateConfig($id,$player_id,$player_key,$player_value,$player_status)
    {
		$sql="UPDATE ".$this->player_table
		." (`id`,`player_id`,`player_key`,`player_value`,`player_status`)"
		."VALUES (".$id.",".$player_id.",'".$player_key."','".$player_value."','".$player_status."')";
		$query = $this->db->query($sql);
		$ret='';
		return $ret;
    }
   /*******************
	* Wert in Config aktualisieren
	*******************/
	function getRole()
	{

	}
   /*******************
	* PersonalMessage
	*******************/
	function getPM()
	{

	}
   /*******************
	* PersonalMessage
	*******************/
	function setPM()
	{

	}
}