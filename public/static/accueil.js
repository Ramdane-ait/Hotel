let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}
function showSlides(n) {
    let slides = document.getElementsByClassName('slides');
    let dots = document.getElementsByClassName('dot');
    
    if(n > slides.length) { slideIndex = 1 }
    
    if(n < 1 ) { slideIndex = slides.length }
    

    for(let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    
    
    for(let i = 0; i < dots.length; i++) {
      dots[i].classList.remove('active');
    }

    slides[slideIndex - 1].style.display = 'block';

    dots[slideIndex - 1].classList.add('active');
  }

  var autoplayInterval = setInterval(function() {
    document.getElementById("next").click();
  }, 3500);


const modal = document.getElementById("myModal");


const btn = document.getElementById("noter");


const span = document.getElementsByClassName("close")[0];


function noter() {
  event.preventDefault();
  modal.style.display = "block";
}

function star(num){
  event.preventDefault();
  document.getElementById('star').setAttribute('value',num);
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 
  