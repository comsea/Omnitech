/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// enable the interactive UI components from Flowbite
import 'flowbite';

// Slider page recrutement
$(document).ready(function(){
    $('.recrutement').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        arrows: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: true,
              arrows: false
            }
    }]
      });
  });

// Navbar
const toggleButton = document.getElementById('toggle-button');
const navList = document.getElementById('nav');

const hide = () => {
  navList.classList.remove('active');
}

toggleButton.addEventListener('click', event => {
  event.stopPropagation()
  navList.classList.toggle('active');
})

const handleClosure = event => !navList.contains(event.target) && hide()

window.addEventListener('click', handleClosure)
window.addEventListener('focusin', handleClosure)

// Tabs
const boutons = document.querySelectorAll('.oui');

boutons.forEach(bouton => {
  bouton.addEventListener('click', () => {
    // Retire la classe 'selected' de tous les boutons
    boutons.forEach(btn => {
      btn.classList.remove('selected');
    });

    // Ajoute la classe 'selected' uniquement au bouton cliqué
    bouton.classList.add('selected');
  });
});