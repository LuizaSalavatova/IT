<?php

$errors_keys = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $len =  is_strLen_valide(2, 255, $_POST['name']);
    if (isset($len)) {
        $errors['name'] = $len;
    }

    if (empty($_POST['project'])) {
        $errors['project'] = 'Пустое поле проекта';
    }

    if (!empty($_POST['date'])) {
        if (!is_date_valid($_POST['date']) ) {
            $errors['date'] = 'Формат даты должен соответствовать ГГГГ-ММ-ДД';
        }else if(strtotime("today") > strtotime($_POST['date'])){
            $errors['date'] = 'Введенная дата должна быть больше или равна текущей';
        }
    }

    if (isset($_FILES) && $_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 2097152) {          
        $errors['file'] = 'Недопуустимый объем файла. Он должен соответствовать 2МБ ';
    }

    if (count($errors)) {
        $errors_keys = array_keys($errors);
    }else{
        $file_ur = null;
        if (isset($_FILES) && $_FILES['file']['error']==0) {

                $file_name = $_FILES['file']['name'];
                $file_url = 'uploads/' . $file_name;

                move_uploaded_file($_FILES['file']['tmp_name'], $file_url);
        }

        Add_Task($con, $_POST['name'], $file_url, empty($_POST['date'])? null: $_POST['date'], $user_id, $_POST['project']);
        header("Location: /index.php?project=".$projectz[array_search($_POST['project'], array_column($projectz, "ID"))]['Title']);

    }
}

?>

<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
        	<?php foreach ($projectz as $key => $projez): ?>

            <li class="main-navigation__list-item">
                <a class="main-navigation__list-item-link" href="index.php?project=<?=htmlspecialchars($projez['Title']); ?>"><?=htmlspecialchars($projez['Title']); ?></a>
                <span class="main-navigation__list-item-count"> <?=$projez['Quantity']; ?> </span>
            </li>

            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="" method="POST" autocomplete="off" enctype="multipart/form-data">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?= in_array('name', $errors_keys)? "form__input--error":"" ?>" type="text" name="name" id="name" value="<?=getPostVal('name')?>" placeholder="Введите название" required maxlength="255">
            
            <?= in_array('name', $errors_keys)? "<p class='form__message'>".$errors['name']."</p>":"" ?>
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select <?= in_array('project', $errors_keys)? "form__input--error":"" ?>" name="project" id="project" required>
                <option value="" selected disabled hidden>Выберите проект</option>
                <?php foreach ($projectz as $key => $projez): ?>
                    <option  <?= isset($_POST['project']) && htmlspecialchars($projez['ID']) === $_POST['project'] ?"selected":"" ?> value="<?=htmlspecialchars($projez['ID']); ?>"><?=htmlspecialchars($projez['Title']); ?></option>
                <?php endforeach; ?>
            </select>
            <?= in_array('project', $errors_keys)? "<p class='form__message'>".$errors['project']."</p>":"" ?>
          </div>

          <div class="form__row">
            <label class="form__label " for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?= in_array('date', $errors_keys)? "form__input--error":"" ?>" type="text" name="date" id="date" value="<?=getPostVal('date')?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <?= in_array('date', $errors_keys)? "<p class='form__message'>".$errors['date']."</p>":"" ?>
          </div>




          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input  class="visually-hidden" type="file" name="file" id="file" value="<?=$_FILES['file']?>">
              <label class="button button--transparent <?= in_array('file', $errors_keys)? "form__input--error":"" ?>" for="file">
                <span>Выберите файл</span>
              </label>
            </div>
            <?= in_array('file', $errors_keys)? "<p. class='form__message'>".$errors['file']."</p>":"" ?>
          </div>



          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
</main>
