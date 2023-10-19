<!-- Ваш HTML-код -->
<div id="main-div">
    <h1>Lorem ipsum dolor sit amet, consectetur</h1>
    <div id="inner-div">
        @foreach ($items as $item)
            <p class="some-item">{{ $item }}</p>
        @endforeach
    </div>
    <h2>Lorem ipsum dolor sit amet, consectetur laborum.</h2>
    <a class="click-me-to-update-piece-of-code" href="#">Click to update the inner-div</a>
</div>

<script>
    // Функция для выполнения AJAX-запроса и обновления inner-div
function updateInnerDiv() {
    // Отправка AJAX-запроса на маршрут в Laravel
    fetch('/fetch-div-update') // Замените '/your-update-route' на фактический URL вашего маршрута
        .then(response => response.json()) // Ожидаем JSON-ответ
        .then(data => { // Переименовываем data в items
            // Очищаем inner-div
            const innerDiv = document.getElementById('inner-div');
            innerDiv.innerHTML = '';

            // Добавляем новые элементы на основе полученных данных
            data.forEach(item => {
                const p = document.createElement('p');
                p.className = 'some-item';
                p.textContent = item;
                innerDiv.appendChild(p);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Обработчик события клика на ссылке
document.querySelector('.click-me-to-update-piece-of-code').addEventListener('click', function (event) {
    event.preventDefault(); // Предотвращение перехода по ссылке
    updateInnerDiv(); // Вызов функции обновления inner-div
});
</script>
