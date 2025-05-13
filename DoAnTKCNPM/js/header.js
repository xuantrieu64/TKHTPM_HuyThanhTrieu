const listImage = document.querySelector('.list-image');
const img = listImage.querySelectorAll('img'); // sửa chỗ này
let current = 0;
const length = img.length;
const intervalTime = 3000;

setInterval(() => {
    if (current === length - 1) {
        listImage.style.transform = `translateX(0px)`;
        current = 0;
    } else {
        current++;
        let width = img[0].offsetWidth;
        listImage.style.transform = `translateX(${width * -1 * current}px)`;
    }
}, intervalTime);
