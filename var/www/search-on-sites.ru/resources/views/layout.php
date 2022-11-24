<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Search On Sites</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="header mt-5">
    <div class="container">
        <div class="row">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    Меню
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/">Главная</a></li>
                    <li><a class="dropdown-item" href="/tasks">Задачи</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<main class="mt-3">
    <?php
    use App\Core\View;

    /** @var View $view */
    /** @var \App\Core\Application $app */
    $view = $app->provider()->get(View::class);
    $view->render($nextTemplate, $nextVariables);
    ?>
</main>

<div class="footer">
    <div class="container">
        <div class="row">
            FOOTER
        </div>
    </div>
</div>


</body>
</html>
