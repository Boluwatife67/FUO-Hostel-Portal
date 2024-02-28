// testimonial slider

let testSlide = document.querySelectorAll('.real-div-sub');
let dots = document.querySelectorAll('.dot');

var counter = 0; 

function switchTest(currentTest){
    currentTest.classList.add('activee')
    var testId = currentTest.getAttribute('attr');
    if (testId > counter){
        testSlide[counter].style.animation = 'next1 0.5s ease-in forwards';
        counter = testId;
        testSlide[counter].style.animation = 'next2 0.5s ease-in forwards';
    }
    else if(testId == counter){
        return;
    }
    else{
        testSlide[counter].style.animation = 'prev1 0.5s ease-in forwards';
        counter = testId;
        testSlide[counter].style.animation = 'prev2 0.5s ease-in forwards';
    }
    indicators();
};
function indicators(){
    for(t = 0; t < dots.length; t++){
        dots[t].className = dots[t].className.replace(' activee' , '');
    }
    dots[counter].className += ' activee';
};
function nextSlide(){
    testSlide[counter].style.animation = 'next1 0.5s ease-in forwards';
    if(counter >= testSlide.length - 1){
        counter = 0;
    }
    else{
        counter++;
    }
    testSlide[counter].style.animation = 'next2 0.5s ease-in forwards';
    indicators();
};
function autoSliding(){
    deleteInterval = setInterval(timer, 6000);
    function timer(){
        nextSlide();
        indicators();
    }
};
autoSliding();

const containerr = document.querySelector('.seven-dot');
containerr.addEventListener('mouseover', pause);
function pause(){
    clearInterval(deleteInterval);
};

containerr.addEventListener('mouseout', autoSliding);
