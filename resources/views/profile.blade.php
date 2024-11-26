<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        form{
            margin: 4rem auto;
            padding: 1rem 3rem;
            border-radius: 1rem;
            background-color: rgba(236, 209, 208, 0.5);
            max-width: 475px;
        }

        form > label > input{
            width: 100%;
            height: 2rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 1rem;
            padding: 0.5rem 1rem;
        }


        form > button{
            margin: 1rem 0;
            padding: 0.5rem 1rem;
            font-weight: 800;
        }

        form > button:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Name : <input type="text" name="name" id="name" value="{{ $user->name}}" placeholder="enter your name"></label>
        <label for="email">Email : <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="enter your email"></label>
        <label for="nickname">NickName : <input type="text" name="nickname" id="nickname" value="{{ $user->nickname }}" placeholder="enter your nickname"></label>
        <button type="submit">Save</button>
    </form>
</body>
</html>