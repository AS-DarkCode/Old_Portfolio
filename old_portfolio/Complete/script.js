// for cards
var swiper = new Swiper(".swiper", {
    effect: "cards",
    grabCursor: true,
    initialSlide: 2,
    speed: 500,
    loop: true,
    rotate: true,
    mousewheel: {
    invert: false,
  },
});

//btn
function showMessage(message) {
    alert(message);
}

function moveButton() {
    const noButton = document.getElementById('noButton');
    const maxWidth = window.innerWidth - noButton.clientWidth;
    const randomNumber = Math.floor(Math.random() * maxWidth);
    noButton.style.left = randomNumber + 'px';

    setTimeout(() => {
        noButton.style.left = '0';
    }, 500);
}