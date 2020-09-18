<?php
$con = mysqli_connect("doingsdone", "root", "root","schema");
$ID_user = 1;
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}

 else {
 	
    $sql = "SELECT * FROM проект WHERE Автор=" .$ID_user;
    $result = mysqli_query($con, $sql);
    $projectz = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	$sql = "SELECT * FROM задача WHERE Автор=" .$ID_user;
    $result = mysqli_query($con, $sql);
    $taskz = mysqli_fetch_all($result, MYSQLI_ASSOC);	

}

mysqli_set_charset($con, "utf8");

$show_complete_tasks = rand(0, 1);


function esc($str) {
    $text = htmlspecialchars($str);
    return $text;
}


function ret_cout_t($mas, $prj){
    $cp = 0;
    foreach ($mas as $key => $ts){
     if($ts['Категория'] === $prj){$cp++;};
    };
    return $cp;
};

require_once("helpers.php");

$page_content = include_template('main.php', ['projectz' => $projectz,'taskz' => $taskz, 'show_complete_tasks' => $show_complete_tasks]);

$layout_content = include_template('layout.php', [
'content' => $page_content,
'title' => 'Дела в порядке'
]);
print($layout_content);


?>