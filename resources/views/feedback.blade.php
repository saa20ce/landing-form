<DOCTYPE html>
<html>
<head>
    <title>Новая заявка с формы обратной связи</title>
</head>
<body>
    <h1>Новая заявка с формы обратной связи </h1>
    @isset($name)
        <p>Ваше имя:<div id="name-container">{{$name}}</div></p>
    @endisset
    <p>Номер телефона:<div id="phone-container">{{$phone}}</div></p>
</body>
<script>
document.getElementById('form1').addEventListener('submit', function(event) {
    event.preventDefault();

    // Здесь добавьте код для отправки данных формы с помощью AJAX
    // и обработки ответа, как в предыдущем примере с выводом сообщения

    fetch('/feedback1', {
        method: 'POST',
        body: new FormData(event.target)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('name-container').innerHTML = 'Ваше имя: ' + data.name;
            document.getElementById('phone-container').innerHTML = 'Номер телефона: ' + data.phone;
        } else {
            // Обработка ошибок, если необходимо
        }
    });
});
</script>

</html>
