<html>
    <header>
        <title>study</title>
    </header>
    <body>
        <div>
            @foreach($list as $praiy)
                <div>{{$praiy->user->name}}</div>
                <div>{{$praiy->num}}</div>
            @endforeach
        </div>
    </body>
</html>
