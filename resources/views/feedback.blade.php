<DOCTYPE html>
<html>
<head>
    <title>Новая заявка с формы обратной связи</title>
</head>
<body>
    <h1>Новая заявка с формы обратной связи </h1>
    @isset($name)
        <p>Ваше имя: {{$name}}</p>
    @endisset
    <p>Номер телефона:{{$phone}}</p>
</body>
</html>
