<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Csrf Token</title>
</head>

<body>
    <form action="/form" method="post">
        <label for="name">
            <input type="text" name="name">
        </label>
        <input type="submit" value="say hello">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>
</body>

</html>