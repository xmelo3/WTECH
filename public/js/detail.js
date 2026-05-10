function changeQty(delta) {
    const input = document.getElementById('qty');
    const val = parseInt(input.value) || 1;
    input.value = Math.max(1, val + delta);
}

function switchThumb(el, url, isExtra) {
    document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    const img = document.getElementById('mainImg');
    img.src = url;
    img.classList.toggle('extra-view', !!isExtra);
}

function switchTab(btn, id) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
    btn.classList.add('active');
    document.getElementById(id).style.display = 'block';
}
