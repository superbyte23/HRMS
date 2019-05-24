<?php
// class programming
// {
// 	public function language($name, $architecture)
// 	{
// 		$name = "PHP";
// 		$architecture = "WINDOWS";
// 		return;
// 	}
// }


// language($name, $architecture);

$date = date_create();

$new_date = date_format($date, 'm/d/Y');


if ($new_date == '06/11/2018') {
	echo "today";
}
else{
	echo "not today";
}
?>