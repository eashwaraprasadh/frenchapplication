// js/pricing.js

document.addEventListener('DOMContentLoaded', function () {
    const monthlyBtn = document.getElementById('monthly-btn');
    const yearlyBtn = document.getElementById('yearly-btn');
    const highlight = document.getElementById('switch-highlight');
    const pricingCards = document.querySelectorAll('.pricing-card');

    // Ensure all elements exist before adding event listeners
    if (!monthlyBtn || !yearlyBtn || !highlight || pricingCards.length === 0) {
        console.error("Pricing section elements not found. Aborting script.");
        return;
    }

    function setPricingView(isYearly) {
        pricingCards.forEach(card => {
            const monthlyPrice = card.querySelector('.price-monthly');
            const yearlyPrice = card.querySelector('.price-yearly');

            if (monthlyPrice && yearlyPrice) {
                if (isYearly) {
                    monthlyPrice.style.display = 'none';
                    yearlyPrice.style.display = 'flex';
                } else {
                    monthlyPrice.style.display = 'flex';
                    yearlyPrice.style.display = 'none';
                }
            }
        });

        if (isYearly) {
            yearlyBtn.classList.add('active');
            monthlyBtn.classList.remove('active');
            // The highlight's width is 50% of the container, so moving it 100% of its own width is correct.
            highlight.style.transform = 'translateX(100%)';
        } else {
            monthlyBtn.classList.add('active');
            yearlyBtn.classList.remove('active');
            highlight.style.transform = 'translateX(0%)';
        }
    }

    monthlyBtn.addEventListener('click', () => setPricingView(false));
    yearlyBtn.addEventListener('click', () => setPricingView(true));

    // Initialize the view to show monthly prices by default
    setPricingView(false);
});
