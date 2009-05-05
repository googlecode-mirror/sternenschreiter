<?php
class Cronmodel extends Model {

    var $cron_table;
    var $planet_table;
    var $player_table;
    var $player_planet_table;
    var $player_stock_table;
    var $ress;


    function Cronmodel()
    {
        // Call the Model constructor
        parent::Model();
        $this->cron_table=$this->config->item('TABLE_CRON');
        $this->planet_table=$this->config->item('TABLE_PLANET');
        $this->player_table=$this->config->item('TABLE_PLAYER');
        $this->player_planet_table=$this->config->item('TABLE_PLAYER_PLANET');
        $this->player_stock_table=$this->config->item('TABLE_PLAYER_PLANET');
        $this->ress=$this->config->item('ress');
    }


   /*******************
	* Cron auslesen 3a2360c8-6c27-102c-88cf-b33b109cdf8a
	*******************/
    function getCron()
    {
		$sql="SELECT * FROM ".$this->cron_table." WHERE (`cron_start`+`cron_duration`) < CURRENT_TIMESTAMP()";
		$query = $this->db->query($sql);
		$ret=$query->result_array();
		return $ret;
    }
   /*******************
	* Neuen Wert in Config schreiben
	*******************/
	function insertNewCron()
    {

    }
   /*******************
	* Cron aktualisieren
	*******************/
    function updateCron($id)
    {
		switch($id)
		{
			case 1://RES
				$myress=json_decode($this->ress, true);
				$player_id='';
				$planet_id='';
				$sql="SELECT `player_id` FROM ".$this->player_table."";
				$query = $this->db->query($sql);
				$player_array=$query->result_array();
				foreach($player_array as $player)
				{
				$sql="SELECT `player_id` FROM ".$this->player_planet_table." WHERE `player_id`='".$player['player_id']."'";
				$query = $this->db->query($sql);
				$planetarray=$query->result_array();
					foreach($planetarray as $planet)
					{

						foreach($ress as $key=>$value)
						{
							$stock_key=$key;
							$sql="SELECT `stock_value` FROM ".$this->player_stock_table." WHERE `player_id`='".$player['player_id']."' and `planet_id`='".$planet['planet_id']."' and `stock_key`='".$stock_key."'";
							$query = $this->db->query($sql);
							$stockarray=$query->result_array();

							$stockvalue=10;
							$sql="UPDATE ".$this->player_stock_table."set `stock_value`=`stock_value`+".$stockvalue." where `stock_key`='".$stock_key."' and `player_id`='".$player_id."' and `planet_id`='".$planet_id."'";
							$query = $this->db->query($sql);
							$ret=$query->result_array();
						}
					}

				}
							break;
			default:
			break;
		}

	}
   /*******************
	* Kill Cron
	*******************/
    function killConfig()
    {


	}
}