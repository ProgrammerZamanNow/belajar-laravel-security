<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todos</title>
</head>
<body>
<h1>Todos</h1>
<table>
    @foreach($todos as $todo)
        <tr>
            <td>{{$todo->title}}</td>
            <td>
                @can('update', $todo)
                    Edit
                @else
                    No Edit
                @endcan

                @can('delete', $todo)
                    Delete
                @else
                    No Delete
                @endcan
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
