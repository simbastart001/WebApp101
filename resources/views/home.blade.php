<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Import the external CSS -->
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <header>Welcome to the VFOC website</header>

    @auth
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <p style="margin: 0;">Welcome, {{ auth()->user()->name }}!</p>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button style="padding: 5px 10px; background-color: #FF0000; color: white; border: none; border-radius: 5px; cursor: pointer;">Logout</button>
            </form>
        </div>

        <!-- Create Post Section -->
        <div>
            <h2>VFOC HELP DESK</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input name="title" type="text" placeholder="Log Title">
                <textarea name="body" placeholder="Body content..." rows="5"></textarea>
                <button>Create Log Request</button>
            </form>
        </div>

        <!-- Display Current User's Posts -->
        <div>
            <h2>LOG REQUSTS</h2>
            @foreach ($posts as $post)
            <div class="post">
                <h3>{{ $post['title'] }}</h3>
                <p>{{ $post['body'] }}</p>
                <div class="post-actions">
                    <a href="/edit-post/{{ $post->id }}">Edit</a>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="container auth-section">
     

        <!-- Register Section -->
<div>
    <h2>Register</h2>
    <!-- Display Validation Errors -->
    @if ($errors->any())
    <div style="color: red; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Register Form -->
    <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="Name" value="{{ old('name') }}">
        <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
        <input name="password" type="password" placeholder="Password">
        <button>Register</button>
    </form>
</div>        

<!-- Login Section -->
<div>
    <h2>Login</h2>

    <!-- Display error popup if validation fails -->
    @if ($errors->any())
        <script type="text/javascript">
            // Show the first error message in a popup
            alert('Error: {{ $errors->first() }}');
        </script>
    @endif

    <form action="/login" method="POST">
        @csrf
        <input name="loginname" type="text" placeholder="Name" value="{{ old('loginname') }}">
        <input name="loginpassword" type="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</div>

    </div>
    @endauth
</body>

</html>
