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
        const cartBody = document.querySelector('.cart-card');
        let str = "";

       if(typeof(obj.data) == 'object'){
        for(let i = 0; i < obj.data.length; i++){
          let row = obj.data[i];

          str += `
          <div class="mt-5">
            <div class="cart-content-header text-center pt-2">
              <h3>Please review your order</h3>
            </div>
            <div class="cart-box">
                <div class="row">
                  <div class="col-xl-6 mb-xl-5 image-box">
                    <div class="d-flex flex-column">
                      <div class="d-flex flex-row justify-content-between px-4 py-3">
                        <h4 class="font-oswold">${row.cart_item}</h4>
                        <p class="text-blue">Ksh ${row.price}</p>
                      </div>
                      <div class="d-flex">
                        <div class="cart-img-box">
                          <img src="${row.image}"/>
                          <div class="mt-4"><button class="btn btn-danger btn-sm" id="cart-delete">Delete</button></div>
                        </div>
                        <div class="px-5">
                          <p>Value: Ksh${row.price}</p>
                          <div class="d-flex mb-2">
                              <span class="badge bg-secondary">Quantity: ${row.quantity}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4 mt-xl-0 col-xl-6">
                    <div class="cart-icon-box d-flex justify-content-between px-3 py-3">
                        <div class="cart-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            <span>${row.quantity} items</span>
                        </div>
                        <span>Ksh ${row.price}</span>
                    </div>
                    <div class="my-3">
                      <button class="btn btn-primary btn-lg cart-btn font-oswold">GO TO CHECKOUT</button>
                    </div>
                    <div class="my-3">
                      <button class="btn btn-danger btn-lg cart-btn font-oswold">GO BACK HOME</button>
                    </div>
                  </div>
                </div>
            </div>
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





