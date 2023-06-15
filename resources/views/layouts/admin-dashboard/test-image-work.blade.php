

<form method="POST" action="{{ route('image.upload.post') }}" enctype="multipart/form-data">
    @csrf

    <input type="file" name="images[]" multiple>
    <button type="submit">Загрузить</button>
</form>
<?php
// // Выводим имя товара и изображение
// echo "Имя товара: $productName";
// echo "<img src='/multimedia/$fileName' alt='Изображение'>";
