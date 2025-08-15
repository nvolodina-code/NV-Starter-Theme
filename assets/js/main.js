document.addEventListener('DOMContentLoaded', () => {
    console.log('works');
    window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    header.classList.toggle('is-scrolled', window.scrollY > 10);
    });
});