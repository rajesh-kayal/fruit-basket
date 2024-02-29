    document.querySelectorAll('.btn-minus').forEach(button => {
        button.addEventListener('click', function(event) {
            const input = this.closest('.quantity').querySelector('input[type="text"]');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
            event.preventDefault();
        });
    });

    document.querySelectorAll('.btn-plus').forEach(button => {
        button.addEventListener('click', function(event) {
            const input = this.closest('.quantity').querySelector('input[type="text"]');
            const currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            event.preventDefault();
        });
    });

// update total value 

    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            updateTotal(this); 
        });
    });

    document.querySelectorAll('.btn-plus').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity').querySelector('input.quantity-input');
            input.value = parseInt(input.value) + 1; 
            updateTotal(input); 
        });
    });

    document.querySelectorAll('.btn-minus').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity').querySelector('input.quantity-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1; 
                updateTotal(input); 
            }
        });
    });

    function updateTotal(input) {
        const quantity = parseInt(input.value);
        const price = parseFloat(input.getAttribute('data-price'));

        const total = quantity * price;

        const totalField = input.closest('tr').querySelector('.total');
        totalField.textContent = '$' + total.toFixed(2); 
    }

    // Calculate subtotal and total
    function calculateTotal() {
        let subtotal = 0;
        document.querySelectorAll('.total').forEach(totalElement => {
            subtotal += parseFloat(totalElement.textContent.substring(1));
        });
        const shipping = 3.00; // Flat rate shipping
        const total = subtotal + shipping;
        document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
        document.getElementById('total').textContent = '$' + total.toFixed(2);
    }

    // Call calculateTotal initially
    calculateTotal();

