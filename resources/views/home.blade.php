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
            <div>

                <h1>
                    Congrats!! You are logged in
                </h1>
                <div style="display: flex; flex-direction: column; gap: 1rem; margin: 2rem 0;">
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
                <div style="border: 3px solid orangered; width: 30rem; margin: 2rem 0;">
                    <h2>
                        Create a new post
                    </h2>
                    <form action="/create-post" method="POST" style="">
                        @csrf
                        <div style="margin: 2.5rem 0">
                            <label style="display: block" for="title">Title</label>
                            <input placeholder="title..." type="text" name="title" id="title">
                        </div>
                        <div style="margin: 2.5rem 0;">
                            <label style="display: block" for="body">Body</label>
                            <textarea placeholder="Write your text..." name="body" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit">
                            Post
                        </button>
                    </form>
                </div>

                <form action="/logout" method="POST">
                    @csrf
                    <button>
                        Logout
                    </button>
                </form>

                <div style="margin: 4rem 0">
                    <h3>All of the posts!!</h3>

                    @foreach ($posts as $post)
                        <div style="border: 3px solid orangered; width: 30rem; margin: 2rem 0;">
                            <h2>
                                {{ $post['title'] }}
                            </h2>
                            <p>
                                {{ $post['body'] }}
                            </p>
                            <p>
                                {{ $post['created_at'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div style="margin: 4rem 0;">
                    <h3>
                        Your posts
                    </h3>

                    @foreach ($userPosts as $post)
                        <div style="border: 3px solid orangered; width: 30rem; margin: 2rem 0;">
                            <h2>
                                {{ $post['title'] }}
                            </h2>
                            <p>
                                {{ $post['body'] }}
                            </p>
                            <p>
                                {{ $post['created_at'] }}
                            </p>
                            <div class="post-modifiers" style="display: flex; gap: 2rem; align-items: center;">
                                <a style="padding: 0.5rem 0.8rem;border-radius: 5px; text-decoration: none; color:  blueviolet; background: white; border: 1px solid salmon"
                                    href="/edit/post/{{ $post->id }}">
                                    Edit
                                </a>
                                <form style="margin:0;" action="/delete/post/{{$post->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button style="padding: 0.5rem 0.8rem;border-radius: 5px; text-decoration: none; color:  blueviolet; background: white; border: 1px solid salmon">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
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
