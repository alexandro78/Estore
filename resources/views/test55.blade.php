<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        .thumbnail-img:hover {
            cursor: pointer;
        }

        .arrow {
            font-size: 30px;
            color: white;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .left-arrow {
            left: 10px;
            /* Расстояние от левого края оригинала изображения */
        }

        .right-arrow {
            right: 10px;
            /* Расстояние от правого края оригинала изображения */
        }

        .arrow:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div>
        <div class="image-container">
            <img class="thumbnail-img" src="/images/thumbnails/DSCN6845.JPG" alt="img45"
                data-original-src="/images/multimedia/DSCN6845.JPG">

            <img class="thumbnail-img" src="/images/thumbnails/DSCN6845.JPG" alt="img45"
                data-original-src="/images/multimedia/DSCN6846.JPG">

            <img class="thumbnail-img" src="/images/thumbnails/DSCN6845.JPG" alt="img45"
                data-original-src="/images/multimedia/fern_leaves_green_123899_2560x1600.jpg">

        </div>

        <div id="image-modal" class="modal">
            <span class="close" id="close-modal">&times;</span>
            <img class="modal-content" id="original-img">
            <span class="arrow left-arrow" id="left-arrow">&#9664;</span>
            <span class="arrow right-arrow" id="right-arrow">&#9654;</span>
        </div>
    </div>

    <script>
        // Находим элементы на странице
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        const modal = document.getElementById('image-modal');
        const originalImg = document.getElementById('original-img');
        const closeBtn = document.getElementById('close-modal');
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');

        let currentImageIndex = 0;

        // Добавляем обработчик события для клика на каждую миниатюру
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', function() {
                currentImageIndex = index;
                const originalSrc = this.getAttribute('data-original-src');
                originalImg.src = originalSrc;
                modal.style.display = 'block';
            });
        });

        // Добавляем обработчик события для закрытия модального окна
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Добавляем обработчики событий для стрелок
        leftArrow.addEventListener('click', function() {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                const originalSrc = thumbnails[currentImageIndex].getAttribute('data-original-src');
                originalImg.src = originalSrc;
            }
        });

        rightArrow.addEventListener('click', function() {
            if (currentImageIndex < thumbnails.length - 1) {
                currentImageIndex++;
                const originalSrc = thumbnails[currentImageIndex].getAttribute('data-original-src');
                originalImg.src = originalSrc;
            }
        });

        // Закрываем модальное окно при клике за его пределами
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>

</html>
