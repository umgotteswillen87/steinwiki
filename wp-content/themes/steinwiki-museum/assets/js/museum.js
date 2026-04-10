(function () {
  const cards = document.querySelectorAll('.object-card');
  cards.forEach((card) => {
    card.addEventListener('mouseenter', () => card.classList.add('is-lit'));
    card.addEventListener('mouseleave', () => card.classList.remove('is-lit'));
  });
})();
