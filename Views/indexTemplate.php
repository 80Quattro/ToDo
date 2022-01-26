<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $this->params['title'] ?></title>
  <meta name="description" content="A simple HTML5 Template for new projects.">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <?php echo $loadStylesheetsString ?>

</head>

<body>
    <?php echo $viewString ?>

    <?php echo $loadScriptsString ?>
</body>
</html>
