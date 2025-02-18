$(document).ready(function() {
    const productItems = document.querySelectorAll('.product-item');

    productItems.forEach(product => {
        // Получение кнопок и количества товара для каждого товара
        const plusBtn = product.querySelector('.plus-btn');
        const minusBtn = product.querySelector('.minus-btn');
        const quantityElement = product.querySelector('.quantity');

        // Обработка события клика на кнопке "плюс"
        plusBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityElement.textContent); // Получение текущего количества товара
            quantity++; // Увеличение количества товара на 1
            quantityElement.textContent = quantity; // Обновление количества товара
            document.querySelector(`input[name="count[${product.dataset.productId}]"]`).value = quantity; // Обновление значения скрытого поля с количеством товара
        });

        // Обработка события клика на кнопке "минус"
        minusBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityElement.textContent); // Получение текущего количества товара
            if (quantity > 0) { // Проверка, чтобы количество не стало отрицательным
                quantity--; // Уменьшение количества товара на 1
                quantityElement.textContent = quantity; // Обновление количества товара
                document.querySelector(`input[name="count[${product.dataset.productId}]"]`).value = quantity; // Обновление значения скрытого поля с количеством товара
            }
        });
    });
    const productItemsAdd = document.querySelectorAll('.product-item-add');
    productItemsAdd.forEach(product => {
        // Получение кнопок и количества товара для каждого товара
        const plusBtn = product.querySelector('.plus-btn');
        const minusBtn = product.querySelector('.minus-btn');
        const quantityElement = product.querySelector('.quantity');

        // Обработка события клика на кнопке "плюс"
        plusBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityElement.textContent); // Получение текущего количества товара
            quantity++; // Увеличение количества товара на 1
            quantityElement.textContent = quantity; // Обновление количества товара
            document.querySelector(`input[name="quantity[${product.dataset.productId}]"]`).value = quantity; // Обновление значения скрытого поля с количеством товара
        });

        // Обработка события клика на кнопке "минус"
        minusBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityElement.textContent); // Получение текущего количества товара
            if (quantity > 0) { // Проверка, чтобы количество не стало отрицательным
                quantity--; // Уменьшение количества товара на 1
                quantityElement.textContent = quantity; // Обновление количества товара
                document.querySelector(`input[name="quantity[${product.dataset.productId}]"]`).value = quantity; // Обновление значения скрытого поля с количеством товара
            }
        });
    });



})

