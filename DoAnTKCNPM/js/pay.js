// Form nhap dia chi
const adress = document.querySelector('#adress-form.pay-icon-right');
const adressclose = document.querySelector('#adress-close');

adress.addEventListener("click", function () {
    document.querySelector('.adress-form').style.display = "flex";
});
adressclose.addEventListener("click", function () {
    document.querySelector('.adress-form').style.display = "none";
});

//Form chon voucher
const voucher = document.querySelector('#voucher-form.voucher-icon');
const voucherClose = document.querySelector('#voucher-close');

voucher.addEventListener('click', function () {
    document.querySelector('.voucher-form').style.display = "flex";
});
voucherClose.addEventListener('click', function () {
    document.querySelector('.voucher-form').style.display = "none";
});

// Xử lý sự kiện chọn voucher
const voucherItems = document.querySelectorAll('.voucher-item');
const btnApply = document.querySelector('.btn-submit');
const voucherForm = document.querySelector('.voucher-form');
let valueVoucher = null;
let nameVoucher = null;
let currentSelected = null;

function resetSelected() {
    if (currentSelected) {
        currentSelected.classList.remove('selected');
        const radioButton = currentSelected.querySelector('.input[type="radio"]');
        if (radioButton) {
            radioButton.checked = false;
        }
        currentSelected = null;
    }
    valueVoucher = null;
    nameVoucher = null;
}

voucherItems.forEach(item => {
    const radioButton = item.querySelector('input[type="radio"]');
    const elementVoucher = item.querySelector('.confident p:first-child');

    //Them su kien click khi nhan vao voucher item
    item.addEventListener('click', () => {
        if (currentSelected && currentSelected !== item) {
            currentSelected.classList.remove('selected');
            const nextRadio = currentSelected.querySelector('input[type="radio"]');
            if (nextRadio) {
                nextRadio.checked = false;
            }
        }
        //chon voucher vua click
        item.classList.add('selected');
        radioButton.checked = true;
        valueVoucher = radioButton.value;
        nameVoucher = elementVoucher ? elementVoucher.textContent : '';
        currentSelected = item;
    });
    radioButton.addEventListener('change', function () {
        if (this.checked) {
            if (currentSelected && currentSelected !== item) {
                currentSelected.classList.remove('selected');
            }
            item.classList.add('selected');
            valueVoucher = this.value;
            nameVoucher = elementVoucher ? elementVoucher.textContent : '';
            currentSelected = item;
        } else if (currentSelected === item) {
            item.classList.remove('selected');
            valueVoucher = null;
            nameVoucher = null;
            currentSelected = null;
        }
    });
});
btnApply.addEventListener('click', (event) => {
    event.preventDefault(); //Khong cho gui
    if (nameVoucher) {
        voucherForm.style.display = 'none';
        resetSelected();
    } else {
        alert('Vui long chon 1 voucher');
    }
});


// Form chon phuong thuc thanh toan
const pay = document.querySelector('#method-pay-form.method-pay-icon');
const payClose = document.querySelector('#pay-close');

pay.addEventListener("click", function () {
    document.querySelector('.method-pay-form').style.display = "flex";
});
payClose.addEventListener("click", function () {
    document.querySelector('.method-pay-form').style.display = "none";
});


