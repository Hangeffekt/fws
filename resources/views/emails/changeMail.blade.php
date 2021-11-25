<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt</title>
</head>
<body>
    @if($data["option"] == "new")
        <h3>Új projekthez adták hozzá</h3>
    @elseif($data["option"] == "delete")
        <h3>Önt a {{ $data["title"] }} című projektből törölték!</h3>
    @else
        <h3>{{ $data["old_title"] }} változásai</h3>
    @endif

    @if($data["title"] != null || $data["option"] != "delete")
        <div class="col-12">
            Cím: {{ $data["title"] }}
        </div>
    @endif

    @if($data["description"] != null)
        <div class="col-12">
            Leírás: {{ $data["description"] }}
        </div>
    @endif

    @if($data["status"] != null)
        <div class="col-12">
            Státusz: {{ $data["status"] }}
        </div>
    @endif
</body>
</html>