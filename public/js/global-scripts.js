// change navbar on scroll
// #######################

let navTop = document.querySelector('.nav-top');
let elementTop = document.querySelector('.nav-top .top');
let link = document.getElementById('link');
let burger = document.getElementById('burger');
let menu = document.querySelector('.navbar .menu');
let nav = document.querySelector('.navbar');
let title = document.querySelector('body .nav-top .header p');
let search  = document.querySelector('body .search');
let searchForm = document.querySelector('.search-div');
let newsletterValidator = document.querySelector('.section-congratulation');


window.onscroll = function() {

  if(document.documentElement.scrollTop > 80) {

    elementTop.style.display = 'none';
    menu.style.display = "none";
    burger.classList.remove("open");
    title.style.margin = "0";
    searchForm.style.display = "none";
    newsletterValidator.style.display = "none";

  }

  else {

      elementTop.style.display = 'flex';
      title.style.margin = "2rem 0";

    
  }
}

// burger menu to cross on click
// ##############################

link.addEventListener('click', function() {

    // if menu is openned
    if(burger.classList.contains('open')) {

        menu.style.display = "none";
        burger.classList.remove("open");
        menu.classList.remove('load');
        nav.classList.remove('load');

    }
    // if menu is closed
    else {
        
        burger.classList.add('open');
        menu.classList.add('load');
        nav.classList.add('load');
        menu.style.display = "flex";
    }
})
