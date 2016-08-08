<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>测试与json相关的两个函数</title>
</head>
<style>
	body{padding:50px;background:#ddd;}
</style>
<body>
<?php
	$array = [
		"a"=> "1",
		1 => 2,
		'2' => 1,
		'aa' => 'bc',
	];

	echo $array; //
	var_dump($array); //

	$result = json_encode($array);

	echo $array; //
	var_dump($array); //
?>
</body>
</html>