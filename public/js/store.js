/* Sort */
document.getElementById('sort-select').addEventListener('change', function () {
    const url = new URL(window.location.href);
    if (this.value) {
        url.searchParams.set('sort', this.value);
    } else {
        url.searchParams.delete('sort');
    }
    url.searchParams.delete('page');
    window.location.href = url.toString();
});

/* Dual range price slider */
(function () {
    const minSlider  = document.getElementById('min-price-slider');
    const maxSlider  = document.getElementById('max-price-slider');
    const minDisplay = document.getElementById('price-min-display');
    const maxDisplay = document.getElementById('price-max-display');
    const fill       = document.getElementById('range-fill');
    const SPAN       = parseInt(minSlider.max) - parseInt(minSlider.min);
    const MIN        = parseInt(minSlider.min);

    function update(moved) {
        let lo = parseInt(minSlider.value);
        let hi = parseInt(maxSlider.value);
        if (lo > hi) {
            if (moved === minSlider) { minSlider.value = hi; lo = hi; }
            else                    { maxSlider.value = lo; hi = lo; }
        }
        minDisplay.textContent = '$' + lo;
        maxDisplay.textContent = '$' + hi;
        fill.style.left  = ((lo - MIN) / SPAN * 100) + '%';
        fill.style.width = ((hi - lo)  / SPAN * 100) + '%';
    }

    minSlider.addEventListener('input', function () { update(this); });
    maxSlider.addEventListener('input', function () { update(this); });
    update(null);
}());

/* Favourites */
const FAV_KEY = 'store_favourites';

function getFavourites() {
    try { return JSON.parse(localStorage.getItem(FAV_KEY)) || []; }
    catch (e) { return []; }
}

function toggleFavourite(btn) {
    const id   = parseInt(btn.dataset.productId);
    const img  = btn.querySelector('.heart-icon');
    const favs = getFavourites();
    const idx  = favs.indexOf(id);
    if (idx === -1) {
        favs.push(id);
        img.src = img.dataset.full;
        btn.setAttribute('aria-label', 'Remove from favourites');
    } else {
        favs.splice(idx, 1);
        img.src = img.dataset.empty;
        btn.setAttribute('aria-label', 'Add to favourites');
    }
    localStorage.setItem(FAV_KEY, JSON.stringify(favs));
}

document.addEventListener('DOMContentLoaded', function () {
    const favs = getFavourites();
    document.querySelectorAll('.favourite-btn').forEach(function (btn) {
        if (favs.includes(parseInt(btn.dataset.productId))) {
            const img = btn.querySelector('.heart-icon');
            img.src = img.dataset.full;
            btn.setAttribute('aria-label', 'Remove from favourites');
        }
    });
});

/* Share */
function handleShare(btn) {
    const url   = btn.dataset.shareUrl;
    const title = btn.dataset.shareTitle;
    if (navigator.share) {
        navigator.share({ title, url }).catch(() => {});
    } else {
        navigator.clipboard.writeText(url).then(function () {
            const prev = btn.getAttribute('aria-label');
            btn.setAttribute('aria-label', 'Link copied!');
            setTimeout(() => btn.setAttribute('aria-label', prev), 2000);
        });
    }
}
