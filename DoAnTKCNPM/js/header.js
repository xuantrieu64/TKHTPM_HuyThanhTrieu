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

document.addEventListener("DOMContentLoaded", () => {
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('click', (e) => {
        e.preventDefault(); // Ngăn chặn chuyển hướng link

        const items = dropdownMenu.querySelectorAll('li');
        const itemHeight = 42.5; // px
        const totalHeight = items.length * itemHeight;

        // Toggle hiển thị
        if (dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
            dropdownMenu.style.height = '0px';
        } else {
            dropdownMenu.classList.add('show');
            dropdownMenu.style.height = totalHeight + 'px';
        }
    });
});
