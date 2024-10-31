<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@auth 
<h1>congrats you are loggedIN</h1>
<h1>create A post</h1>

<form action='/create-post' method='POST'>
    @csrf
    <input name='title' type="text" placeholder="title">
    <textarea name='body' type="text" placeholder="body"></textarea>
    <button>create post</button>

</form>

<h1>all Posts</h1>
@foreach($posts as $post )
<div style="background-color: gray; border: 3px solid black">
   
    <div>
        <div>
            <h2>{{$post['title']}}</h2>
            <h1>this post was created by {{$post->user->name}}</h1>
        </div> 
        <p>{{$post['body']}}</p>
    </div>
    
    <div style="display: flex; flex-direction: row; justify-content: space-between">
        <a href="/edit-post/{{$post->id}}"><p>edit Post</p></a>
        <form action='/delete-post{{$post->id}}' method='POST'>
            @csrf
            <button style="background-color: red">Delete Post</button>
        
        </form>
    </div>
</div>
@endforeach
<form action='/logout' method='POST'>
    @csrf
<button >logout</button>
</form>
@else

<h1>this is a home page REGISTER</h1>
    <form action="/register" method="POST">
        @csrf 
        <input name="name" type="text" placeholder="name">
        <input name="password" type="password" placeholder="password">
        <input name="email" type="email" placeholder="email">
        <button>register</button>

    </form>



    <h1>this is a home page LOGIN</h1>
    <form action="/login" method="POST">
        @csrf 
        <input name="loginemail" type="email" placeholder="email">
        <input name="loginpassword" type="password" placeholder="password">
        <button>login</button>

    </form>

    

@endauth
</body>
</html>