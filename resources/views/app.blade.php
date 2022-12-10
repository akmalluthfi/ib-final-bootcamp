<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="shortcut icon" href="https://laravel.com/img/favicon/favicon.ico">
  <link rel="stylesheet" href="/css/app.css">

  <title>Vue App</title>
</head>

<body>

  <div id="app">
    <router-view></router-view>
  </div>

  <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>
