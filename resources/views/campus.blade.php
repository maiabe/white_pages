<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div>
            @foreach ($data as $item)
            <li>{{$item}}</li>
            @endforeach
        </div>
    </body>
</html>