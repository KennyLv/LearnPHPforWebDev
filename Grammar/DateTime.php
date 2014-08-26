<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

$time=date("w");
echo date('Y-m-d',strtotime("-{$time} day"));
echo '<br/>';

$strDate=new DateTime(date('2011-4'));
echo $strDate->format('F');
echo '<br/>';

$strDate=new DateTime(date('Y-m-d'));
echo $strDate->format('W');
echo '<br/><br/><br/>';


$date = new DateTime('2011-4-25');
$weekday=$date->format('w');
echo '=='.$weekday.'<br/>';

$firstweekdays=(6-$weekday);
if($firstweekdays!=6){
		$interval = new DateInterval('P'.$firstweekdays.'D');
		$dateArray=array('start'=>$date,'end'=>$date->add($interval));
		print_r($dateArray);
		echo '<br/>';
		echo $dateArray['end']->format('Y-m-d').'<br/>';
}
echo '<br/>=='.$firstweekdays.'<br/>';

$january = new DateTime('2010-01-01');
$february = new DateTime('2010-02-01');
$interval = $february->diff($january);
echo $interval->format('%m month, %d days');

echo '<br/><br/><br/>';
$out= 100/3;
echo $out.'<br/>';
echo ceil($out).'<br/>';
echo floor($out).'<br/>';
echo intval($out).'<br/>';
echo round($out).'<br/>';


?>
