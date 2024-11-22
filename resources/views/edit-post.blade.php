<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT POST</title>
</head>
<body>
    <form action="edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$post->title}}"> 
        <textarea name="body">{{$post->body}}</textarea>
        <button>Save Changes</button>
    </form>   
</body>
</html>