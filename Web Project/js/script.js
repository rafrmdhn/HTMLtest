const navbarNav = document.querySelector('.navbar-nav');
const hamburger = document.querySelector('#hamburger-menu');
const body = document.body;

document.querySelector('#hamburger-menu').onclick = () => {
    navbarNav.classList.toggle('active');
    body.classList.toggle('active-menu'); // Add or remove the class
};

document.addEventListener('click', function(e) {
    if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove('active');
        body.classList.remove('active-menu'); // Remove the class
    } 
});
