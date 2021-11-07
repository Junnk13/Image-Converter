<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Image Converter</title>
</head>
<body>
<div class="container-fluid">
    <h3>Конвертер изображений</h3>
    <form class="form-control" action="image.php" method="post" enctype="multipart/form-data">
        <p>Изображения:
            <input class="form-control" id="formFile" type="file" name="pictures[]"><br>
            <label class="form-label"> Укажите ширину
                <input type="number" name="Width">
            </label><br>
            <label class="form-label"> Укажите высоту
                <input type="number" name="Height">
            </label><br>
            <label class="form-check-label">
                <input class="form-check-input" id="inlineRadio1" type="radio" name="ext" value="jpg">
                Jpg</label>
            <label class="form-check-label">
                <input class="form-check-input" id="inlineRadio1" type="radio" name="ext" value="png">
                png</label>
            <br>
            <button type="submit" class="btn btn-success">Сконвертировать</button>
        </p>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "extension")
                echo '<span class="error" >Не поддерживаемое расширение</span>';
            if ($_GET["error"] == "size")
                echo '<span class="error" >Файл слишком большой</span>';
            if ($_GET["error"] == "load")
                echo '<span class="error" >Ошибка загрузки</span>';
            if ($_GET["error"] == "width")
                echo '<span class="error" >Укажите ширину</span>';
            if ($_GET["error"] == "height")
                echo '<span class="error" >Укажите высоту</span>';
            if ($_GET["error"] == "ext")
                echo '<span class="error" >Укажите формат</span>';
        }
        ?>
    </form>
    <?php
    if (isset($_GET["new-jpg"])) {
        echo '<img src="result/result.jpg">';
    }
    if (isset($_GET["new-png"])) {
        echo '<img src="result/result.png">';
    }
    ?>
</div>
</body>
</html>