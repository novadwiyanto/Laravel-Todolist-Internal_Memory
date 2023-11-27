<!DOCTYPE html>
<html>

<head>
    <style>
        html {
            height: 100%;
        }

        body {
            background: linear-gradient(#132444, #094e80);
            font-family: sans-serif;
        }
        
        .login-box {
            position: relative;
            top: 0%;
            left: 50%;
            width: 400px;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
        }


        .login-box .user-box input {
            width: 250px;
            padding: 5px;
            margin: 20px;
            font-size: 16px;
            color: #fff;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }

        .btn {
            width: 20%;
            margin-top: 30px;
            font-size: 16px;
            padding: 5px 20px;
            border-radius: 5px;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            text-transform: uppercase;
        }

        .btn:hover,
        .logout:hover {
            background: #02427e;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #fff,
                0 0 25px #fff,
                0 0 50px #fff,
                0 0 100px #fff;
        }

        .grid-container {
            display: grid;
            gap: 25px 20px;
            grid-template-columns: auto auto auto;
            padding: 10px;
        }

        .grid-item {
            width: 340px;
            height: 35px;
            background: rgba(0, 0, 0, 0.4);
            padding: 20px;
            font-size: 20px;
            text-align: center;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
            color: white;
            text-transform: uppercase;
        }

        .lavel {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .b-delete {
            position: absolute;
            margin-top: 8px;
            font-size: 10px;
            color: rgb(255, 255, 255);
            background-color: transparent;
            border: none;
            outline: none;
            color: #6b6b6b;
        }

        .b-delete:hover {
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #ff0000,
                0 0 25px #ff0000,
                0 0 50px #ff0000,
                0 0 100px #ff0000;
        }

        .logout {
            margin: 20px;
            width: fit-content;
            border-radius: 5px;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <form action="/logout" method="post">
        @csrf
        <button class="logout">Logout</button>
    </form>
    <div class="login-box">
        <form method="post" action="/todolist">
            @isset ($error)
            <p style="position: absolute; font-size: 8px; color:#fff; padding-left: 10px;">{{$error}}</p>
            @endisset
            @csrf
            <div class="user-box">
                <input type="text" name="todo" placeholder="Insert Todolist">
                <button type="submit" class="btn">add</button>
            </div>
        </form>
    </div>

    <div class="grid-container">
        @foreach($todolist as $todo)
        <div class="grid-item">
            <div class="lavel">
                {{$todo['todo']}}
            </div>
            <div class="b-delete">
                <form action="/todolist/{{$todo['id']}}/delete" method="post">
                    @csrf
                    <button type="submit" class="b-delete">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>