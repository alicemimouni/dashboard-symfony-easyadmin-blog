let video = document.querySelector('.detail-article .content-article .video video');
let buttonPlay = document.querySelector('.detail-article .content-article .video .play img');

function playVideo() {
  // if video is paused show play button and start video on click
  // if video is playing stop video and show button play

  video.addEventListener('click', function () {

    if (!video.paused) {

      video.pause();
      buttonPlay.style.display = "flex";
    }
  })

  buttonPlay.addEventListener('click', function () {

    if (video.paused) {

      video.play();
      buttonPlay.style.display = "none";
    } else {

      video.pause();
      buttonPlay.style.display = "flex";
    }
  })
}

if (video) {

  playVideo();
}