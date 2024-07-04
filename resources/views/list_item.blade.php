<!-- resources/views/list_item.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Item</title>
</head>
<body>
    <h2>List Item</h2>
    <ul>
        @foreach($items as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
</body>
</html>
