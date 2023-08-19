<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>
        Edit your post
    </h1>
    <form method="POST" action="/edit-post/{{$post->id}}">

        @csrf
        @method('PUT')

        <div style="margin: 2.5rem 0">
            <label style="display: block" for="title">Title</label>
            <input placeholder="title..." type="text" name="title" id="title" value="{{$post->title}}">

        </div>

        <div style="margin: 2.5rem 0;">
            <label style="display: block" for="body">Body</label>
            <textarea placeholder="Write your text..." name="body" cols="30" rows="10">{{$post->body}}</textarea>
        </div>

        <button type="submit">
            Save changes
        </button>

    </form>


</body>
</html>
