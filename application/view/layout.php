<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>СПИСОК ЗАДАЧ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Andrey Kononyuk">
    <meta name="generator" content="MVC Test 2">

    <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo URL; ?>css/ico.png" />
  </head>
  <body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><a href='./'>СПИСОК ЗАДАЧ</a></h5>
<? if ($admin_login): ?>
  <a class="btn btn-outline-primary" href="/tasks/logout">ВЫХОД</a>
<? else: ?>
  <a class="btn btn-outline-primary" href="/tasks/login">АВТОРИЗАЦИЯ</a>
<? endif; ?>
</div>


<div class="container">

<?php echo $content; ?>

</div>
  
  
  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
    </div>
  </footer>


    <script src="<?php echo URL; ?>js/jquery-3.5.0.min.js"></script>

    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <script src="<?php echo URL; ?>js/application.js"></script>

</body>
</html>