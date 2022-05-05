// change navbar on scroll
// #######################

let navTop = document.querySelector('.nav-top');
let elementTop = document.querySelector('.nav-top .top');

window.onscroll = function() {


        if(document.documentElement.scrollTop > 80) {
      
          elementTop.style.display = 'none';
    
        }
    
        else {
      
            elementTop.style.display = 'flex';
        }
    }