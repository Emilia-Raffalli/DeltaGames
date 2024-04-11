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


