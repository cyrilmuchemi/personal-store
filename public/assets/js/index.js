const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".navigation-list");
const mode = document.getElementById('toggleDarkLight');
const light = document.getElementById('toggleLight');
const header = document.getElementById('header');
const navBar = document.getElementById('nav-bar');
const body = document.getElementById('body');
const mains = document.querySelectorAll('#main');
const navLinks = document.querySelectorAll('.navlink');
const logos = document.querySelectorAll('.front-logo')
const category = document.querySelectorAll('.category-card');
const bars = document.querySelectorAll('.bar');
const boxSearch = document.querySelector('.box-search');
const browseCategories = document.querySelector('.browse-categories-box');
const searcher =document.querySelector('.searcher');
const blogPage = document.getElementById('blog-page');
const page404 = document.getElementById('404-page'); 
const forgot = document.getElementById('forgot-password');
const content = document.getElementById('content');
const sun = document.querySelector('.bi-brightness-high-fill');
const moon = document.querySelector('.bi-moon-fill');

function setTheme() {
  const currentTheme = localStorage.getItem('theme');
  if (currentTheme === 'dark') {
    darkmode();
  } else {
    lightmode();
  }
}

function toggleTheme() {
  const currentTheme = localStorage.getItem('theme');
  if (currentTheme === 'dark') {
    localStorage.setItem('theme', 'light');
    lightmode();
  } else {
    localStorage.setItem('theme', 'dark');
    darkmode();
  }
}

function darkmode(){
  sun.style.display = "block";
  moon.style.display = "none";
  if(header || body){
    header.classList.remove('main-header');
    header.classList.add('header-dark');
    body.classList.remove('font-default');
    body.style.color = "white";
  }

  if(searcher){
    searcher.style.color = "white";
  }

  if(content){
    content.style.color = "white !important"
  }

  if(forgot){
    forgot.classList.add('body-dark');
  }

  if(page404){
    page404.classList.add('body-dark');
  }

  if(browseCategories){
    browseCategories.style.background = "black";
  }

  if(boxSearch){
    boxSearch.style.background = "black";
  }

  if(blogPage){
    blogPage.classList.add('body-dark');
  }

  if(navMenu){
    const isMobile = window.innerWidth <= 768;
    navMenu.style.background = isMobile ? "black" : "transparent";
  }
 
  navBar.classList.add('bg-blackish');
    if(mains){
    mains.forEach(main => {
        main.classList.remove('body-wrapper');
        main.classList.add('body-dark');
    });
  }
  if(navLinks){
    navLinks.forEach(link => {
      link.style.color = 'white';
    });
  }
  if(logos){
    logos.forEach(logo => {
      logo.style.color = 'white';
    });
  }
  if(category){
    category.forEach(card => {
      card.style.background = "black";
    });
  }
  if(bars){
    bars.forEach(bar => {
      bar.style.background = "white";
    });
  }
}

function lightmode() {
  sun.style.display = "none";
  moon.style.display = "block";
  if(header || body){
    header.classList.remove('header-dark');
    header.classList.add('main-header');
    body.classList.add('font-default');
    body.style.color = "black";
  }

  if(searcher){
    searcher.style.color = "black";
  }

  if(content){
    content.classList.remove('body-dark');
    content.classList.remove('text-white');
  }

  if(forgot){
    forgot.classList.remove('body-dark');
  }

  if(page404){
    page404.classList.remove('body-dark');
  }

  if(browseCategories){
    browseCategories.style.background = "white";
  }

  if(boxSearch){
    boxSearch.style.background = "white";
  }

  if(blogPage){
    blogPage.classList.remove('body-dark');
  }

  if(navMenu){
    const isMobile = window.innerWidth <= 768;
    navMenu.style.background = isMobile ? "white" : "transparent";
  }
 
  navBar.classList.remove('bg-blackish');
    if(mains){
    mains.forEach(main => {
      main.classList.remove('body-dark');
        main.classList.add('body-wrapper');
    });
  }
  if(navLinks){
    navLinks.forEach(link => {
      link.style.color = 'black';
    });
  }
  if(logos){
    logos.forEach(logo => {
      logo.style.color = 'black';
    });
  }
  if(category){
    category.forEach(card => {
      card.style.background = "white";
    });
  }
  if(bars){
    bars.forEach(bar => {
      bar.style.background = "black";
    });
  }
}

mode.addEventListener('click', toggleTheme);
light.addEventListener('click', toggleTheme);
setTheme();
window.addEventListener("resize", setTheme);

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active"); 
    navMenu.classList.toggle("active");
})

document.querySelectorAll(".navlink").forEach(n => n.addEventListener('click', () => {
  hamburger.classList.remove("active")
  navMenu.classList.remove("active")
}));


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

function rafScroll() {
  requestAnimationFrame(debouncedScroll);
}

window.addEventListener('scroll', rafScroll);
window.addEventListener('resize', handleResize);

document.addEventListener('DOMContentLoaded', function () {
  showLoader();

  window.addEventListener('load', function () {
      hideLoader();
  });

  document.addEventListener('click', function (event) {
      const target = event.target;
      if (target.tagName === 'A' && !target.getAttribute('target')) {
          showLoader();
      }
  });
});

function showLoader() {
  const loaderOverlay = document.getElementById('loader-overlay');
  loaderOverlay.style.display = 'flex';
}

function hideLoader() {
  const loaderOverlay = document.getElementById('loader-overlay');
  loaderOverlay.style.display = 'none';
}

sendData({}, 'read');

function sendData(obj, type) {
  let form = new FormData();

  for (let key in obj) {
    form.append(key, obj[key]);
  }

  form.append('data_type', type);

  let ajax = new XMLHttpRequest();

  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      handleResult(ajax.responseText);
    }else{
      console.error('HTTP Error:', this.status);
    }
  };

  ajax.open('post', '/personal-store/app/core/cart.php', true);
  ajax.send(form);
}

function handleResult(result) {

  if (!result) {
    console.log("Empty response");
  }else{
    console.log(result)
  }

  let obj = JSON.parse(result);
  
  if(typeof(obj) == 'object'){
      if(obj.data_type == 'read')
      {
        const cartBody = document.querySelector('.cart-body');
        let str = "";

       if(typeof(obj.data) == 'object'){
        for(let i = 0; i < obj.data.length; i++){
          let row = obj.data[i];

          str += `
          <div>
            <p>${row.id}</p>
            <p>${row.product_id}</p>
            <p>${row.user_id}</p>
            <p>${row.quantity}</p>
            <p>${row.created_at}</p>
            <p>${row.price}</p>
          </div>
          `;
        }
       }else{
        str = "No records found!";
       }
        cartBody.innerHTML = str;
        
      }else if(obj.data_type == 'save'){
        if(obj.error){
          alert("Error:" + obj.error);
        }else{
          alert(obj.data);
          sendData({}, 'read');
        }
      }
    }

}

const addToCart = document.getElementById('add-to-cart');

addToCart.addEventListener('click', function(){
  let obj = {
    product_id : this.value
  }

  sendData(obj, 'save');

});





