<html>
    <head></head>
    <body>
<h1>Bienvenid@ {{$data['name']}}</h1>
<a href="{{url()}}/confirm/email/{{$data['email']}}/confirm_token/{{$data['confirm_token']}}">Confirmar mi cuenta</a>
    </body>
</html>