<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<form action="" method="get">
    @csrf
    @if( !isset($film['Poster']) )
        @foreach ($film as $data)
        <img src="{{ $data['Poster'] }}" alt="no poster">
            <h2 >{{ $data['Title'] }}</h2>
            <h3>{{ $data['Year'] }}</h3>
            <h3>{{ $data['Rated'] }}</h3>
            <h3>{{ $data['Released'] }}</h3>
            <h3>{{ $data['Runtime'] }}</h3>
            <h3>{{ $data['Genre'] }}</h3>
            <h3>{{ $data['Director'] }}</h3>
            <h3>{{ $data['Writer'] }}</h3>
            <h3>{{ $data['Actors'] }}</h3>
            <h3>{{ $data['Plot'] }}</h3>
        @endforeach
    @endif
</form>
</body>
</html>
