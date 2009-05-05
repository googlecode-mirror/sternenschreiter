<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Function Library
*
* @package    CodeIgniter
* @author     franxx
* @see        http://www.franxxweb.de
*             
*/

class GeneralFunc{
	var $temp='';
	function GeneralFunc(){
	
	}
	function CoordDist($pos1 =Array(),$pos2 =Array())
	{
		$pos1Dist=$pos1['Dist'];
		$pos2Dist=$pos2['Dist'];
		$pos1Angle=$pos1['Angle'];
		$pos2Angle=$pos2['Angle'];
		$A=$pos1Dist*sin($pos1Angle);
		$B=$pos2Dist*sin($pos2Angle);
		$C=$pos1Dist*cos($pos1Angle);
		$D=$pos2Dist*cos($pos2Angle);
		$AA=abs($B-$A);
		$BB=abs($C-$D);		
		$Distance=sqrt($AA*$AA+$BB*$BB);
		return $Distance;
	}
}
?>