function toggleMenu() {
    document.getElementById('hamburgerOverlay').classList.toggle('active');
}
document.getElementById('hamburgerOverlay').addEventListener('click', function (e) {
    if (e.target === this) toggleMenu();
});
