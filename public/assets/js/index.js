const hamburger = document.querySelector(".hamburger");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active"); 
})


let navigation = document.getElementById('sticky-navigation');
let navigationOffset = navigation.offsetTop;
let isSticky = false;

function handleScroll() {
  let scrollPosition = window.scrollY;

  if (scrollPosition > navigationOffset && !isSticky) {
    navigation.classList.add('sticky');
    isSticky = true;
  } else if (scrollPosition < navigationOffset && isSticky) {
    navigation.classList.remove('sticky');
    isSticky = false;
  }

}

window.addEventListener('scroll', handleScroll);


