// change navbar on scroll
// #######################

let navTop = document.querySelector('.nav-top');
let elementTop = document.querySelector('.nav-top .top');
let link = document.getElementById('link');
let burger = document.getElementById('burger');
let menu = document.querySelector('.navbar .menu');
let nav = document.querySelector('.navbar');

window.onscroll = function() {

  if(document.documentElement.scrollTop > 80) {

    elementTop.style.display = 'none';
    menu.style.display = "none";
    burger.classList.remove("open");

  }

  else {

      elementTop.style.display = 'flex';
    
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
