
let elementTop = document.querySelector('.top-header');
let navTop = document.querySelector('.top-header .header');
let link = document.getElementById('link');
let burger = document.getElementById('burger');
let menu = document.querySelector('.menu');
let nav = document.querySelector('.navbar');
let title = document.querySelector('.header p');
let search  = document.querySelector('.search img'); //search icon
let searchForm = document.querySelector('.searchbar'); //searchbar
let newsletterValidator = document.querySelector('.section-congratulation');
let titleOne = document.querySelector('h1');
let titleTwo = document.querySelectorAll('h2');
let titleThree = document.querySelectorAll('h3');
// detail article div
let detailArticle = document.querySelector('body div.detail-article');
// image thimbnail in detail article
let imageArticle = document.querySelector('div.detail-article .content-article img.image-article');
// all images in section all articles
let imagesCard = document.querySelectorAll('section.articles .cards-container .card picture');
let cards = document.querySelectorAll('section.articles .cards-container .card');
// change navbar on scroll
// #######################
window.onscroll = function() {

  if (document.documentElement.scrollTop >= 80) {

    elementTop.style.top = '-79.7167px';
    navTop.style.top = '0';
    menu.style.display = "none";
    burger.classList.remove("open");

    // if (searchForm) {
    //   searchForm.style.display = "none";
    // }
    if (newsletterValidator) {
      newsletterValidator.style.display = "none";
    }
  }
  else {
      elementTop.style.top = '0px';
      navTop.style.top = '79.7167px';
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

    }
    // if menu is closed
    else {
        
        burger.classList.add('open');
        menu.classList.add('load');
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
    
    // console.log(element.innerHTML);
    element.innerHTML = element.innerHTML.replace('?', '&nbsp?');  
  }

  if(element.innerHTML.includes('!')) {
    
    // console.log(element.innerHTML);
    element.innerHTML = element.innerHTML.replace('!', '&nbsp!');   
  }

  if(element.innerHTML.includes(':')) {
    
    // console.log(element.innerHTML);
    element.innerHTML = element.innerHTML.replace(':', '&nbsp:'); 
  }
});


// IN PAGE DETAIL ARTICLE REMOVE ARTICLE IN SECTION ALL ARTICLES WHEN IT IS THE SAME
function removeArticle() {

  if(detailArticle) {
    imagesCard.forEach(picture => {
        if(picture.getElementsByTagName("img")[0].src == imageArticle.src) {
          picture.getElementsByTagName("img")[0].parentNode.parentNode.style.display = "none";
        }
    });
  }
}

removeArticle();