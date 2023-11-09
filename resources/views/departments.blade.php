<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <table id="table" border="1">
            <thead>
                <th>Department</th>
                <th>Location</th>
                <th>Website</th>
                <th>Choice</th>
            </thead>
            <tbody>
                @foreach($data as $dept) 
                    <tr>
                        <td>{{$dept['name']}}</td>
                        <td>{{$dept['location']}}</td>
                        <td>{{$dept['website']}}</td>
                        <td>
                            <input
                                name="dept_choice"
                                type="radio"
                                id={{$dept['id']}}

                            />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>