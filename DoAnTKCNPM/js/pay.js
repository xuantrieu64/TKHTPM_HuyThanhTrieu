// Form nhap dia chi
// const adress = document.querySelector('#adress-form.pay-icon-right');
// const adressclose = document.querySelector('#adress-close');

// adress.addEventListener("click", function () {
//     document.querySelector('.adress-form').style.display = "flex";
// });
// adressclose.addEventListener("click", function () {
//     document.querySelector('.adress-form').style.display = "none";
// });


document.querySelector('button.submit-address').addEventListener('click', function () {
    alert('Hello');
});

const pay = document.querySelector('#method-pay-form.method-pay-icon');
const payClose = document.querySelector('#pay-close');

pay.addEventListener("click", function () {
    document.querySelector('.method-pay-form').style.display = "flex";
});
payClose.addEventListener("click", function () {
    document.querySelector('.method-pay-form').style.display = "none";
});
