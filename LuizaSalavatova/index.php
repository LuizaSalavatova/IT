<?php
$user_id = intval(1);

require_once("connect.php");
require_once("request.php");
require_once("helpers.php");

if(!$con)
{
	print("Error connected: " . mysqli_connect_error());
}
else
{
	$projectz = GET_project($con, $user_id);
	if (isset($_GET['Add_Task']))
	{
		$page_content = include_template('add.php',
		    [
		    	'con' => $con,
		    	'user_id' => $user_id,
		    	'projectz' => $projectz
		    ]);
		$title = 'Добавление задачи - Дела в порядке';

	}
	else
	{
		$page_content = include_template('main.php',
		    [
		    	'con' => $con,
		    	'user_id' => $user_id,
		    	'projectz' => $projectz
		    ]);
		$title = 'Дела в порядке';
	}

	$layout_content = include_template('layout.php', [
		'content' => $page_content,
		'title' => $title
	]);

	print($layout_content);
}
?>

