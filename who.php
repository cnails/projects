#!/usr/bin/php
<?php
	function ft_month($str) {
		switch ($str) {
			case 'Jan':
				return 1;
			case 'Feb':
				return 2;
			case 'Mar':
				return 3;
			case 'Apr':
				return 4;
			case 'May':	
				return 5;
			case 'Jun':
				return 6;
			case 'Jul':
				return 7;
			case 'Aug':
				return 8;
			case 'Sep':	
				return 9;
			case 'Oct':
				return 10;
			case 'Nov':
				return 11;
			case 'Dec':
				return 12;
		}
	}
	exec("last -f /var/run/utmp", $ut);
	$year = explode(" ", preg_replace("/[ ]+/", " ", $ut[count($ut) - 1]));
	$year = $year[count($year) - 1];
	foreach ($ut as $line) {
		$line = explode(" ", preg_replace("/[ ]+/", " ", $line));
		if (strcmp($line[1], "system") === 0)
			break;
		$month = ft_month($line[4]);
		echo str_pad($line[0], 9).str_pad($line[1], 13).$year."-".(strlen($month) == 2 ? $month : "0".$month)."-".(strlen($line[5]) == 2 ? $line[5] : "0".$line[5])." ".$line[6]." "."(".$line[2].")\n";
	}
?>
