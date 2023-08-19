<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        font-family: 'Nunito',
        sans-serif;
    </style>
</head>

<body>

    <head></head>
    <main>
        <h1 style="color: brown; text-decoration: underline">Home</h1>
        <p>Benvenuto nella home page</p>

        @auth
            <h1>
                Congrats!! You are logged in
            </h1>
            <div style="display: flex; flex-direction: column; gap: 1rem">
                <h2>
                    This is your info
                </h2>
                <p>
                    Name: {{ Auth::user()->name }}
                </p>
                <p>
                    Email: {{ Auth::user()->email }}
                </p>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <button>
                    Logout
                </button>
            </form>

        @else
            <section id="user-registration" style="border: 3px dashed blueviolet">
                <h2>
                    Please register
                </h2>
                <form action="/register" method="POST" style="">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                    <button type="submit">
                        Register
                    </button>

                </form>
            </section>
            <section id="user-login" style="border: 3px dashed blueviolet; margin-top: 2rem">
                <h2>
                    Or login
                </h2>
                <form action="/login" method="POST" style="">
                    @csrf
                    <label for="loginname">Name</label>
                    <input type="text" name="loginname" id="login-name">
                    <label for="loginpassword">Password</label>
                    <input type="password" name="loginpassword" id="login-password">
                    <button type="submit">
                        Login
                    </button>
                </form>
            </section>

        @endauth
        </main>

    </body>

    </html>
