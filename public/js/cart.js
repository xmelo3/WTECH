function cartQty(id, delta) {
    const input = document.getElementById('qty-' + id);
    const newVal = Math.max(1, parseInt(input.value) + delta);
    input.value = newVal;
    document.getElementById('qty-form-' + id).submit();
}
