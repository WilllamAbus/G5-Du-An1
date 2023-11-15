// Slider control

let sliderImages = document.querySelectorAll('.slide'),
    arrowLeft = document.querySelector('.btn-l'),
    arrowRight = document.querySelector('.btn-r'),
    current = 0;

// Clear all images
function reset() {
    for (let i = 0; i < sliderImages.length; i++) {
        sliderImages[i].style.display = 'none';
    }
}

// Khởi tạo
function startSlide() {
    reset();
    sliderImages[0].style.display = 'block';

}

// về trc
function slideLeft() {
    reset();
    sliderImages[current - 1].style.display = 'block';
    current--;
}

// Tới
function slideRight() {
    reset();
    sliderImages[current + 1].style.display = 'block';
    current++;
}

// Chọn nút bên trái
arrowLeft.addEventListener('click', function () {
    if (current === 0) {
        current = sliderImages.length;
    }
    slideLeft();
});

// Chọn nút bên phải
arrowRight.addEventListener('click', function () {
    if (current === sliderImages.length - 1) {
        current = -1;
    }
    slideRight();
});

startSlide();