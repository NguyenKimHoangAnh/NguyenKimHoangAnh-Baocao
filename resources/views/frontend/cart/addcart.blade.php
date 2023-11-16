<form id="add-to-cart-form">
    <div>
        <label for="product_id">ID sản phẩm:</label>
        <input type="text" id="product_id" name="product_id">
    </div>
    <div>
        <label for="qty">Số lượng:</label>
        <input type="number" id="qty" name="qty" min="1">
    </div>
    <button type="submit">Thêm vào giỏ hàng</button>
</form>

<div id="response-message"></div>

<script>
    document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var product_id = document.getElementById('product_id').value;
        var qty = document.getElementById('qty').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("addcart") }}');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('response-message').innerText = response.success;
            } else {
                document.getElementById('response-message').innerText = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            }
        };
        xhr.send(JSON.stringify({ product_id: product_id, qty: qty }));
    });
</script>