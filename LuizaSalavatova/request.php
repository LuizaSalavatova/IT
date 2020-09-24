<?php

        //Получение проекта
function GET_project($con, $user_id) {
    $sql = "SELECT ID, Title, Autor, (SELECT COUNT(*) FROM `task` WHERE `Category` = `project`.ID) AS `Quantity`  FROM `project` WHERE `Autor` = ".intval($user_id);
    $result = mysqli_query($con, $sql);
    $projectz = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $projectz;
}

        //Получение задач
function GET_Tasks($con, $user_id) {
    $sql = "SELECT * FROM `task` WHERE `Autor` = " . intval($user_id)." ORDER BY ID DESC";
    $result = mysqli_query($con, $sql);
    $taskz = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $taskz;
}

        //Получение id проекта по его названию
function GET_id_project($con, $user_id, $prjnm) {
    $sql = "SELECT ID FROM `project` WHERE `Autor` = " . $user_id . " AND `Title` = '" . strval($prjnm) . "'";
    $result = mysqli_query($con, $sql);
    $idprjnm =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(count($idprjnm)!=0){
        $idprj =  array_column($idprjnm, 'ID');
    	return $idprj[0];
	}
	return null;
}

//Получение задач по id проекта
function GET_Tasks_id($con, $user_id, $idprj) {
    $sql =  "SELECT * FROM `task` WHERE `Autor` = ".$user_id." AND `Category` = ".$idprj." ORDER BY ID DESC";
    $result = mysqli_query($con, $sql);
    $taskz = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $taskz;
}

        //Действия с задачами
function Add_Task($con, $name, $file, $date_c = null, $user_id, $proj) {
    if(empty($date_c)) {$date_c = null;};
    print($file);
    if(empty($file)) {$file = null;};
    $sql = "INSERT INTO `task` (`CreatDate`, `Completed`, `Task`, `File`, `CompletionDate`, `Autor`, `Category`) VALUES (NOW(), 0, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'sssii', $name, $file, $date_c, $user_id, $proj);

    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    return true;
}


?>
