<!DOCTYPE html>
<html>

<head>
    <style>
        html {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(#132444, #094e80);
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            padding: 40px;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
        }

        .login-box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #fff;
            text-align: center;
        }

        .login-box .user-box {
            position: relative;
        }

        .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            pointer-events: none;
            top: -20px;
            left: 0;
            color: #5f6b81;
            font-size: 12px;
        }

        button {
            margin-top: 30px;
            font-size: 16px;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5px;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            text-transform: uppercase;
        }

        button:hover {
            background: #02427e;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #fff,
                0 0 25px #fff,
                0 0 50px #fff,
                0 0 100px #fff;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h2>Login</h2>
        <form method="post" action="/login">
            @csrf
            <div class="user-box">
                <input type="text" name="user">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password">
                <label>Password</label>
            </div>
            @isset ($error)
            <p style="position: absolute; font-size: 8px; color:#fff">{{$error}}</p>
            @endisset
            <button type="submit" class="btn">Sign In</button>
        </form>
    </div>

</body>

</html>