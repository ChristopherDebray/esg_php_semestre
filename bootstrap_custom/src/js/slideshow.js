
function displaySlide(slideToDisplay) {
  let slides = document.getElementsByClassName('slide');
  let slidesLength = slides.length;
  for (i = 0; i < slidesLength; i ++) {
    slides[i].style.display = 'none';
  }
  
  if (slideToDisplay >= slidesLength) {
    slideIndex = 0;
  }
  
  if (slideToDisplay < 0) {
    slideIndex = slidesLength-1;
  }
  
  slides[slideIndex].style.display = 'block';
}

function changeSlide(slideToDisplay) {
  displaySlide(slideIndex += slideToDisplay);
}

let slideIndex = 0;
displaySlide(slideIndex);