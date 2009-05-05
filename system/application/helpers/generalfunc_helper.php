<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Function Helper
*
* @package    CodeIgniter
* @author     franxx
* @see        http://www.franxxweb.de
*
*/


if ( ! function_exists('CoordDist'))
{
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
		$AA=($B-$A);
		$BB=($C-$D);
		$Distance=sqrt($AA*$AA+$BB*$BB);
		return $Distance;
	}
}
// Dauer bei Geschwindigkeit $speed von $posA nach $posB
if ( ! function_exists('Duration'))
{
	function Duration($pos1 =Array(),$pos2 =Array(),$speed)
	{
		return CoordDist($pos1,$pos2)/$speed;
	}
}
// Restzeit
if ( ! function_exists('DurationEstimate'))
{
	function Endtime($duration,$start)
	{
		return time($start+$duration);
	}
}
// Zeitausgabe
if ( ! function_exists('formatTime'))
{
	function formatTime($time_in_minutes)
	{
		$times = array('year'=>31536000 , 'month'=> 2592000, 'week' => 604800, 'day'=> 86400 , 'hour' =>3600, 'minute' => 60 , 'second'=>1 );
		$d=$time_in_minutes;
		$h=fmod($d,$times['day']);
		$m=fmod($h,$times['hour']);
		$s=fmod($m,$times['minute']);
		return sprintf('%sd-%s:%s:%s',floor($d/$times['day']),floor($h/$times['hour']),floor($m/$times['minute']),floor($s/$times['second']));
	}
}
function outputArray($content='Kein Content vorhanden',$info='Keine Infos')
{
		return array('CONTENT'=>$content,'INFO'=>$info);
}
function outputCMD($id='',$cmd='',$txt='')
{
	return '<a href="'.$id.'" alt="'.$cmd.'" class="command">'.$txt.'</a>';

}
?>