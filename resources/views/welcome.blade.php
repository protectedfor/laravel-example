<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Laravel</title>
</head>
<body>
<table border="1">
    <tr>
        <td>id</td>
        <td>title</td>
        <td>description</td>
        <td>order</td>
        <td>active</td>
    </tr>
    @foreach($feeds as $feed)
        <tr>
            <td>{{ $feed->id }}</td>
            <td>{{ $feed->title }}</td>
            <td>{{ $feed->description }}</td>
            <td>{{ $feed->order }}</td>
            <td>{{ $feed->active }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>