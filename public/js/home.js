
let slider = document.querySelector(".img-slider");
let item = document.querySelectorAll('.item');
let line = document.querySelectorAll('.line');

let index = 0;
let slideWidth = item[0].offsetWidth + 50;
let maxIndex = item.length - 1;

console.log(maxIndex);

function nextMove() {
    if (index < maxIndex) {
        index++;
        slider.style.transform = `translateX(-${slideWidth * index}px)`;
    }
}
function backMove() {
    if (index > 0) {
        index--;
        slider.style.transform = `translateX(-${slideWidth * index}px)`;
    }
}

window.addEventListener("resize", () => {
    let slideWidth = item[0].offsetWidth + 50;
    slider.style.transform = `translateX(-${slideWidth * index}px)`;
});

