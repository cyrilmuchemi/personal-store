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

  // Control the circle fill based on scroll position
    const circleFill = document.getElementById('fill');
    const scrollableHeight = document.body.scrollHeight - window.innerHeight;
    const scrolled = window.scrollY;

    const fillPercentage = (scrolled / scrollableHeight) * 100;
    const clampedFillPercentage = Math.min(Math.max(fillPercentage, 0), 100);

    circleFill.style.height = clampedFillPercentage + '%';
}

window.addEventListener('scroll', handleScroll);


