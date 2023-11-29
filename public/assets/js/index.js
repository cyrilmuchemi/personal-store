const hamburger = document.querySelector(".hamburger");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active"); 
})


let navigation = document.getElementById('sticky-navigation');
let isSticky = false;
let navigationRect = navigation.getBoundingClientRect();

function handleScroll() {
  let scrollPosition = window.scrollY;

  if (scrollPosition > navigationRect.top && !isSticky) {
    navigation.classList.add('sticky');
    isSticky = true;
  } else if (scrollPosition < navigationRect.top && isSticky) {
    navigation.classList.remove('sticky');
    isSticky = false;
  }
}

function handleResize() {
  navigationRect = navigation.getBoundingClientRect();
  handleScroll();
}

function debounce(func, wait) {
  let timeout;
  return function () {
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(this, arguments), wait);
  };
}

const debouncedScroll = debounce(handleScroll, 16);

// Use requestAnimationFrame for smoother scrolling
function rafScroll() {
  requestAnimationFrame(debouncedScroll);
}

window.addEventListener('scroll', rafScroll);
window.addEventListener('resize', handleResize);

