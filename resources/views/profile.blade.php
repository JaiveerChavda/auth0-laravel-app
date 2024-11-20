<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
        <input type="text" name="name" id="" value="{{ $user->name}}" placeholder="enter your name">
        <input type="email" name="email" id="" value="{{ $user->email }}" placeholder="enter your email">
    </form>
</body>
</html>