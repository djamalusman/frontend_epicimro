<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page animation | VTcoding</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="jpg" href="icon.jpg">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        font-family: 'jost', sans-serif;
        background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
        display: flex;
    }

    .main {
        width: 350px;
        height: 500px;
        background: red;
        overflow: hidden;
        background: url("https://img.freepik.com/premium-vector/abstract-realistic-technology-particle-background_23-2148414765.jpg?w=740") no-repeat center/ cover;
        border-radius: 10px;
        box-shadow: 5px 20px 50px #000;
    }

    #chk {
        display: none;
    }

    .signup {
        position: relative;
        width: 100%;
        height: 100%;
    }

    label {
        color: #fff;
        font-size: 2.3em;
        justify-content: center;
        display: flex;
        margin: 60px;
        font-weight: bold;
        cursor: pointer;
        transition: .5s ease-in-out;
    }

    input {
        width: 60%;
        height: 20px;
        background: #e0dede;
        justify-content: center;
        display: flex;
        margin: 0px auto;
        padding: 9px;
        border: none;
        outline: none;
        border-radius: 12px;
    }

    button {
        width: 60%;
        height: 40px;
        margin: 10px auto;
        justify-content: center;
        display: block;
        color: #fff;
        background-color: #573b8a;
        font-size: 1em;
        font-weight: bold;
        margin-top: 0px;
        outline: none;
        border: none;
        border-radius: 5px;
        transition: .2s ease-in;
        cursor: pointer;
    }

    button:hover {
        background: #6d44b8;
    }

    .login {
        height: 460px;
        background: #eee;
        border-radius: 60% / 10%;
        transform: translateY(-180px);
        transition: .8s ease-in-out;
    }

    .login label {
        color: #573b8a;
        transform: scale(.6);
    }

    #chk:checked~.login {
        transform: translateY(-500px);
    }

    #chk:checked~.login label {
        transform: scale(1);
    }

    #chk:checked~.signup label {
        transform: scale(.6);
    }
</style>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form>
                <label for="chk"aria-hidden="true">Sign up</label><br>
                <input type="text" name="text" placeholder="user name" required=""><br>
                <input type="email" name="email" placeholder="Email" required=""><br>
                <input type="password" name="password" placeholder="Password" required=""><br>
                <button>Sign up</button>
            </form>
        </div>
        <div class="login">
            <form>
                <label for="chk"aria-hidden="true">Login</label><br>
                <input type="email" name="email" placeholder="Email" required=""><br>
                <input type="password" name="password" placeholder="Password" required=""><br>
                <button>Login</button>
            </form>
        </div>
    </div>
</body>

</html>
