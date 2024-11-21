<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEPAGE</title>
</head>
<body>

    @auth
    <p>Logged in succesfully!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>
    </form>

    {{-- Create Post Section --}}
    <div style="border: 3px solid black;">
        <form action="/create-post" method="POST">
            @csrf
            <h2>CREATE POST</h2>
            <input name = "title" type="text" placeholder="Post Title">
            <textarea name = "body" type="text" placeholder="Body content..."></textarea> 
            <button>Create Post</button>
        </form>
    </div>

    {{-- Display currentLoggedinUser Posts --}}
    <div style="border: 3px solid black;">
        <h2>ALL POSTS</h2>
        @foreach ($posts as $post)
        <div style="background-color:honeydew; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}}</h3>
            {{$post['body']}}
        </div>
        @endforeach
    </div>


    @else
    <div style="border: 3px solid black;">
        <h2>REGISTER</h2>
        <form action="/register" method="POST">
        @csrf
            <input name = "name" type="text" placeholder="name">
            <input name = "email" type="text" placeholder="email">
            <input name = "password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    {{-- for login screen --}}
    <div style="border: 3px solid black;">
        <h2>LOGIN</h2>
        <form action="/login" method="POST">
        @csrf
            <input name = "loginname" type="text" placeholder="name">
            <input name = "loginpassword" type="password" placeholder="password">
            <button>Login</button>
        </form>
    </div>
    @endauth

</body>
</html>