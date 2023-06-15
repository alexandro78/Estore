const labels = document.querySelectorAll('label');
labels.forEach(label => {
    const labelText = label.innerText.trim();
    if (labelText !== 'Опис') {
        label.innerHTML += '<span style="color: red;">*</span>';
    }
});


function removeSpan(spanId, inputElement = false) {
    const existingSpan = document.getElementById(spanId);
    if (existingSpan) {
        existingSpan.remove();
    }
    if (inputElement) {
        inputElement.style.border = '1px solid green'; // Удаление существующего <span> с id="warn"
    }
}

function warnValidator(forAttribute, warningText, inputElement, spanId) {
    const labelElement = document.querySelector(`label[for="${forAttribute}"]`);
    if (labelElement) {
        labelElement.innerHTML += `<span id="${spanId}" style="color: red;">${warningText}</span>`;
        inputElement.style.border = '1px solid red';
    }
}

function isInputValidNumber(digitInputField) {
    var value = digitInputField.value.trim();

    // Проверяем, содержит ли значение только цифры
    var numericPattern = /^\d+$/;
    return numericPattern.test(value);
}

function checkInput() {
    var inputValueDiscName = document.getElementById("disc-name");
    var inputValueDiscSum = document.getElementById("disc-sum");
    var inputValueMinSum = document.getElementById("min-sum");
    var inputValueStartDiscount = document.getElementById("start-discount");
    var inputValueStopDiscount = document.getElementById("stop-discount");
    var passValidate;
    if (inputValueDiscName.value === "") {
        removeSpan('warnFordiscName');
        warnValidator('disc-name', ' Поле не може бути порожнім!', inputValueDiscName, 'warnFordiscName');
        passValidate = true;
    } else {
        removeSpan('warnFordiscName', inputValueDiscName);
    }

    if (inputValueDiscSum.value === "") {
        removeSpan('warnForDiscSum');
        warnValidator('disc-sum', ' Поле не може бути порожнім!', inputValueDiscSum, 'warnForDiscSum');
        passValidate = true;
    } else {
        if (!isInputValidNumber(inputValueDiscSum)) {
            removeSpan('warnForDiscSum');
            warnValidator('disc-sum', ' Поле може вміщати тільки цифри!', inputValueDiscSum, 'warnForDiscSum');
            passValidate = true;
        } else {
            removeSpan('warnForDiscSum', inputValueDiscSum);
        }

    }

    if (inputValueMinSum.value === "") {
        removeSpan('warnForMinSum');
        warnValidator('min-sum', ' Поле не може бути порожнім!', inputValueDiscSum, 'warnForMinSum');
        passValidate = true;
    } else {
        if (!isInputValidNumber(inputValueMinSum)) {
            removeSpan('warnForMinSum');
            warnValidator('min-sum', ' Поле може вміщати тільки цифри!', inputValueMinSum, 'warnForMinSum');
            passValidate = true;
        } else {
            removeSpan('warnForMinSum', inputValueMinSum);
        }

    }


    if (inputValueStartDiscount.value === "") {
        removeSpan('warnForStartDiscount');
        warnValidator('start-discount', ' Поле не може бути порожнім!', inputValueStartDiscount, 'warnForStartDiscount');
        passValidate = true;
    } else {
        removeSpan('warnForStartDiscount', inputValueStartDiscount);
    }

    if (inputValueStopDiscount.value === "") {
        removeSpan('warnForStopDiscount');
        warnValidator('stop-discount', ' Поле не може бути порожнім!', inputValueStopDiscount, 'warnForStopDiscount');
        passValidate = true;
    } else {
        removeSpan('warnForStopDiscount', inputValueStopDiscount);
    }
    
    if (passValidate) {
        return false;
    }
}