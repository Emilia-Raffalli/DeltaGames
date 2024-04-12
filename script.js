document.addEventListener("DOMContentLoaded", function() {
    const allAnswers = document.querySelectorAll(".answers");
    let disableAOS = false; 

    if (window.innerWidth < 768) {
        disableAOS = true; 
    }

    AOS.init({
        disable: disableAOS, 
    });


    allAnswers.forEach(function(answer) {
        answer.addEventListener("click", selectAnswer);
    });


    function selectAnswer(event) {
        const clickedAnswer = event.target;
        
        allAnswers.forEach(function(answer) {
            answer.classList.remove("selected");
        });

        clickedAnswer.classList.add("selected");
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


