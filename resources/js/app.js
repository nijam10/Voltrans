import './bootstrap';

// Navbar color change on scroll

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const logoImage = document.getElementById('logo-image');
    const logoText = document.getElementById('logo-text');
    const menuItems = document.querySelectorAll('.menu-item');
    const searchInput = document.getElementById('search-input');
    const searchIcon = document.getElementById('search-icon');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            // Scrolled state
            navbar.classList.remove('bg-transparent');
            navbar.classList.add('bg-white', 'shadow-md');
            
            // changes logo image
            logoImage.src = 'images/voltrans-green.png';
            logoImage.alt = 'Logo Dark';

            // Change text colors to dark
            logoText.classList.remove('text-white');
            logoText.classList.add('text-green-900');
            
            // Change menu items color
            menuItems.forEach(item => {
                item.classList.remove('text-white');
                item.classList.add('text-black');
            });
            
            // Change search input style
            searchInput.classList.remove('text-gray-300');
            searchInput.classList.add('text-gray-700');
            searchIcon.classList.remove('text-gray-400');
            searchIcon.classList.add('text-gray-700');
            
            // Change mobile menu button
            if (mobileMenuBtn) {
                mobileMenuBtn.classList.remove('btn-success');
                mobileMenuBtn.classList.add('btn-neutral');
            }
            
        } else {
            // Top state (transparent)
            navbar.classList.add('bg-transparent');
            navbar.classList.remove('bg-white', 'shadow-md');
            
            // Change text colors to light
            logoText.classList.add('text-white');
            logoText.classList.remove('text-green-900');
            
            // default logo image
            logoImage.src = 'images/voltrans-white.png';
            logoImage.alt = 'Logo White';

            // Change menu items color
            menuItems.forEach(item => {
                item.classList.add('text-white');
                item.classList.remove('text-black');
            });
            
            // Change search input style
            searchInput.classList.add('text-gray-300');
            searchInput.classList.remove('text-gray-700');
            searchIcon.classList.add('text-gray-400');
            searchIcon.classList.remove('text-gray-700');
            
            // Change mobile menu button
            if (mobileMenuBtn) {
                mobileMenuBtn.classList.add('btn-success');
                mobileMenuBtn.classList.remove('btn-neutral');
            }
        }
    });
});