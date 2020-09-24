<?php
    $show_complete_tasks = 0; //Показ выполненных здч
    $errors = [];

    if (isset($_GET['show_completed']))
    {
        $show_complete_tasks = intval($_GET['show_completed']);
    }

    if (isset($_GET['project']))
    {
        $prjnm = esc($_GET['project']);
        $idprj = GET_id_project($con, $user_id, $prjnm);

        if($idprj!==null){
            $taskz = GET_Tasks_id($con, $user_id, $idprj);
            if(count($taskz) === 0){$errors['УПС. '] = 'Нет задач! <a href="http://luizasalavatova/?Add_Task">Добавьте новую</a>';};
        }else{
            http_response_code(404);
            $errors['Error 404'] = 'не найдено проектов!.';
            $taskz = [];
        }
    }
    else
    {
        $taskz = GET_Tasks($con, $user_id);
        if(count($taskz) === 0){$errors['УПС. '] = '<a href="http://luizasalavatova/?Add_Task">Добавьте новую</a>';};
    }

?>

<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
        	<?php foreach ($projectz as $key => $projez): ?>

            <li class="main-navigation__list-item <?= $projez['Title'] === htmlspecialchars($_GET['project']) ? "main-navigation__list-item--active":"" ?>">
                <a class="main-navigation__list-item-link" href="index.php?project=<?=htmlspecialchars($projez['Title']). (isset($_GET['show_completed']) ? "&show_completed=".$_GET['show_completed'] : "") ?>"><?=htmlspecialchars($projez['Title']); ?></a>
                <span class="main-navigation__list-item-count"> <?=$projez['Quantity']; ?> </span>
            </li>

            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if($show_complete_tasks === 1): ?>checked <?php endif; ?> >
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php
            if(count($errors) != 0){
                foreach ($errors as $key => $value) {
                    echo "<h1><span style='color: #800000'>".$key."</span>".$value."</h1>";
                }
            }
        ?>

    	<?php foreach ($taskz as $key => $tazk): ?>
    		<?php if(($show_complete_tasks === 1 && $tazk['Completed']) || !$tazk['Completed']): ?>
        <tr class="tasks__item task <?php if($tazk['Completed'])echo('task--completed') ?> <?php if( isset($taskz[$key]['DateOfCompletion']) && strtotime($taskz[$key]['DateOfCompletion']) - time() <= 86400)echo('task--important') ?>">
            <td class="task__select">
                <label class="checkbox task__checkbox">
                    <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if($tazk['Completed'])echo('checked') ?>>
                    <span class="checkbox__text"><?=htmlspecialchars($tazk['Task']) ?></span>
                </label>
            </td>
            <?= isset($tazk['File']) ? '<td class="task__file"> <a class="download-link" href="'.$tazk['File'].'">'.getNameFileOfURl($tazk['File']).'</a> </td>' : ""?>


            <?='<td class="task__date">'.$tazk['CompletionDate'].'</td>'?>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </table>
</main>
