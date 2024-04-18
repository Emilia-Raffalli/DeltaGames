import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/lan.scss';


document.addEventListener("DOMContentLoaded", function() {
    const allChoices = document.querySelectorAll(".choice");

    allChoices.forEach(function(choice) {
        choice.addEventListener("click", selectAnswer);
    });

    function selectAnswer(event) {
        const clickedChoice = event.currentTarget;
        
        allChoices.forEach(function(choice) {
            choice.classList.remove("selected");
        });

        clickedChoice.classList.add("selected");
    }
});


//ouverture et fermeture liste au click
$('.select_wrap').click(function() {
    $('.select_wrap ul').slideToggle(200);
});

//fermeture liste au blur
$('.select_wrap').mouseleave(function() {
    $('.select_wrap ul').slideUp(300);
});

//au click sur un li
$('.select_wrap ul li').click(function() {
    //on recupere son contenu
    var affichage = $(this).html();
    //on recupere sa valeur
    var valeur = $(this).attr('data-value');
    
    //on affiche son contenu dans le span
    $('.select_wrap span').html(affichage);
    //on attribue sa valeur à l'input
    $('.select_wrap input').val(valeur);
});
