<?php
$sql = "select name, LastGame from $playerstable where active = 1";
$result = mysql_query($sql,$db) or die ("Failed to  select players");

while ($row = mysql_fetch_array($result)) {
	// Okey, let's convert the crap we store in the database into nice digits, putting the hour, sec, day, month and year in one variable 
	$rawdata = $row[LastGame];
	// Since the format is always identical with the identical number of characters in the time/date string we can just as
	// well use string positioning to rip out what we need. Dirty, but works.

	$hour = substr($rawdata, 0,2);
	$minute = substr($rawdata, 3,2);
	$day = substr($rawdata, 6,2);
	$month = substr($rawdata, 9,2);
	$year = substr($rawdata, 12,2);

	// To get the number of days that has passed since the latest played game we first need to convert the latest-played-game-date into unix epoch seconds. That's easy since we already have all the numbers from the database tucked into nice $variables....

	$unixedlatest = mktime($hour, $minute, 1, $month, $day, $year);
	
	// Now, we take the date today (in seconds since 70) and subtract it with the date then. The result is the difference in seconds.
	$timedifference =  (date("U") - $unixedlatest);

	// Let's convert this into days since we played.
	$daysago = ceil(($timedifference / (24*60*60)));

	// Display the number of days left before setting the player in passive mode...
	$daysleft = $passivedays - $daysago;

	if ($daysleft <= 0) {
		echo "inactive removed $row[name]";
		$sql = "update $playerstable SET active = 0 WHERE name = '" . $row['name'] . "'";
		$resultr = mysql_query($sql,$db);
	}
}
?>
