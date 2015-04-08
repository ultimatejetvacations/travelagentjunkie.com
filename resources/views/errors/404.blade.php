<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">

    <title>Travel Agent Junkie - 404</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.paper.css"/>
    <link rel="stylesheet" href="/assets/css/app.css"/>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="text-center">
                <p style="font-size: 150px; margin-bottom: 80px; line-height: 1">Oops, 404!</p>
                <p style="font-size: 50px; margin-bottom: 0; line-height: 1">
                    @if(isset($message))
                        {{$message}}
                    @else
                        The page you are looking for does not exist.
                    @endif
                </p>
            </div>
        </div>

        <div class="row">

        </div>
    </div>

</body>
</html>


