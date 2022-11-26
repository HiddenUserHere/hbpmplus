<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button id="generateKey">Generate Key</button>
            </div>
            <div class="col-md-6">
                <span id="apitoken"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div style="width: 800px;"><canvas id="heartbeats"></canvas></div>
            </div>
        </div>
</body>

</html>