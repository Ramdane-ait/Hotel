let slide1Index = 1;
showSlides1(slide1Index);

function plusSlides1(n) {
    showSlides1(slide1Index += n);
}

function currentSlide(n) {
    showSlides1(slide1Index = n);
}
function showSlides1(n) {
    let slides1 = document.getElementsByClassName('slides1');
    let dots = document.getElementsByClassName('dot1');
    
    if(n > slides1.length) { slide1Index = 1 }
    
    if(n < 1 ) { slide1Index = slides1.length }
    

    for(let i = 0; i < slides1.length; i++) {
      slides1[i].style.display = "none";
    }
    
    
    for(let i = 0; i < dots.length; i++) {
      dots[i].classList.remove('active');
    }

    slides1[slide1Index - 1].style.display = 'block';

    dots[slide1Index - 1].classList.add('active');
  }


  var autoplayInterval = setInterval(function() {
    document.getElementById("next1").click();
  }, 3500);

  