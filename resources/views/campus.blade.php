<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div>
            @foreach ($data as $item)
            <li>{{$item['name']}}</li>
            @endforeach
        </div>
    </body>
</html>
