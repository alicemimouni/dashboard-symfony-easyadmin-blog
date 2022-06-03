// change navbar on scroll
// #######################


let navTop = document.querySelector('.nav-top');
let elementTop = document.querySelector('.nav-top .top');
let link = document.getElementById('link');
let burger = document.getElementById('burger');
let menu = document.querySelector('.navbar .menu');
let nav = document.querySelector('.navbar');
let title = document.querySelector('.nav-top .header p');
let search  = document.querySelector('.nav-top .search img'); //search icon
let searchForm = document.querySelector('.searchbar'); //searchbar
let newsletterValidator = document.querySelector('.section-congratulation');
let titleOne = document.querySelector('h1');
let titleTwo = document.querySelectorAll('h2');
let titleThree = document.querySelectorAll('h3');


window.onscroll = function() {

  if(document.documentElement.scrollTop > 80) {

    elementTop.style.display = 'none';
    menu.style.display = "none";
    burger.classList.remove("open");
    title.style.margin = "0";
    if (searchForm) {

      searchForm.style.display = "none";
    }

    if(newsletterValidator) {

      newsletterValidator.style.display = "none";
    }

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

// show searchbar on click on search icon
//  #####################################

search.addEventListener('click', function() {

  // if search form is closed
  if(searchForm.style.display = "none") {

      searchForm.style.display = "flex";
  }
 
  // if search form is openned
  else {
      
      menu.style.display = "none";
  }
})

// insert &nbsp; before carcteres ? or : or !
// ###########################################
document.querySelectorAll('h2, h3, h1, p').forEach(element => {

  if(element.innerHTML.includes('?')) {
    
    console.log(element.innerHTML);
    element.innerHTML = element.innerHTML.replace('?', '&nbsp?');  
  }

  if(element.innerHTML.includes('!')) {
    
    console.log(element.innerHTML);
    element.innerHTML = element.innerHTML.replace('!', '&nbsp!');   
  }

  if(element.innerHTML.includes(':')) {
    
    console.log(element.innerHTML);
    element.innerHTML = element.innerHTML.replace(':', '&nbsp:'); 
  }
});

