<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <div class="container">
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" id="username" name="username" placeholder="Username" required />
            <input type="password" id="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
            <div id="message"></div>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
