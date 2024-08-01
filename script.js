document.addEventListener("DOMContentLoaded", function() {
    const heroContent = document.querySelector('.hero-content');
    heroContent.classList.add('show');

    const shopBtn = document.getElementById('shop-btn');
    shopBtn.addEventListener('mouseover', function() {
        shopBtn.textContent = 'Start Shopping!';
    });

    shopBtn.addEventListener('mouseout', function() {
        shopBtn.textContent = 'Check collection';
    });
});
