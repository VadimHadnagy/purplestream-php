const container = document.querySelector(".container"),
mainVideo = container.querySelector("video"),
videoTimeline = container.querySelector(".video-timeline"),
progressBar = container.querySelector(".progress-bar"),
volumeBtn = container.querySelector(".volume i"),
volumeSlider = container.querySelector(".left input");
currentVidTime = container.querySelector(".current-time"),
videoDuration = container.querySelector(".video-duration"),
skipBackward = container.querySelector(".skip-backward i"),
skipForward = container.querySelector(".skip-forward i"),
playPauseBtn = container.querySelector(".play-pause i"),
speedBtn = container.querySelector(".playback-speed span"),
speedOptions = container.querySelector(".speed-options"),
pipBtn = container.querySelector(".pic-in-pic span"),
fullScreenBtn = container.querySelector(".fullscreen i");
let timer;
let h1 = document.querySelector('h1');
let episode = 1;
let tbl = [['kimetsu no yaiba', 25, 2, 1]];
let p = document.querySelector('p');
const button2 = document.querySelector("#btn-next");
let logo = document.querySelector(".logo");

// name, ep, saison, film

mainVideo.volume = 0.5;

const hideControls = () => {
    if(mainVideo.paused) return;
    timer = setTimeout(() => {
        container.classList.remove("show-controls");
    }, 3000);
}
hideControls();

container.addEventListener("mousemove", () => {
    container.classList.add("show-controls");
    clearTimeout(timer);
    hideControls();   
});

const formatTime = time => {
    let seconds = Math.floor(time % 60),
    minutes = Math.floor(time / 60) % 60,
    hours = Math.floor(time / 3600);

    seconds = seconds < 10 ? `0${seconds}` : seconds;
    minutes = minutes < 10 ? `0${minutes}` : minutes;
    hours = hours < 10 ? `0${hours}` : hours;

    if(hours == 0) {
        return `${minutes}:${seconds}`
    }
    return `${hours}:${minutes}:${seconds}`;
}

videoTimeline.addEventListener("mousemove", e => {
    let timelineWidth = videoTimeline.clientWidth;
    let offsetX = e.offsetX;
    let percent = Math.floor((offsetX / timelineWidth) * mainVideo.duration);
    const progressTime = videoTimeline.querySelector("span");
    offsetX = offsetX < 20 ? 20 : (offsetX > timelineWidth - 20) ? timelineWidth - 20 : offsetX;
    progressTime.style.left = `${offsetX}px`;
    progressTime.innerText = formatTime(percent);
});

videoTimeline.addEventListener("click", e => {
    let timelineWidth = videoTimeline.clientWidth;
    mainVideo.currentTime = (e.offsetX / timelineWidth) * mainVideo.duration;
});

mainVideo.addEventListener("timeupdate", e => {
    let {currentTime, duration} = e.target;
    let percent = (currentTime / duration) * 100;
    progressBar.style.width = `${percent}%`;
    currentVidTime.innerText = formatTime(currentTime);
});

mainVideo.addEventListener("loadeddata", () => {
    videoDuration.innerText = formatTime(mainVideo.duration);
});

const draggableProgressBar = e => {
    let timelineWidth = videoTimeline.clientWidth;
    progressBar.style.width = `${e.offsetX}px`;
    mainVideo.currentTime = (e.offsetX / timelineWidth) * mainVideo.duration;
    currentVidTime.innerText = formatTime(mainVideo.currentTime);
}

volumeBtn.addEventListener("click", () => {
    if(!volumeBtn.classList.contains("fa-volume-high")) {
        mainVideo.volume = 0.5;
        volumeBtn.classList.replace("fa-volume-xmark", "fa-volume-high");
    } else {
        mainVideo.volume = 0.0;
        volumeBtn.classList.replace("fa-volume-high", "fa-volume-xmark");
    }
    volumeSlider.value = mainVideo.volume;
});

volumeSlider.addEventListener("input", e => {
    mainVideo.volume = e.target.value;
    if(e.target.value == 0) {
        return volumeBtn.classList.replace("fa-volume-high", "fa-volume-xmark");
    }
    volumeBtn.classList.replace("fa-volume-xmark", "fa-volume-high");
});

speedOptions.querySelectorAll("li").forEach(option => {
    option.addEventListener("click", () => {
        mainVideo.playbackRate = option.dataset.speed;
        speedOptions.querySelector(".active").classList.remove("active");
        option.classList.add("active");
    });
});

document.addEventListener("click", e => {
    if(e.target.tagName !== "SPAN" || e.target.className !== "material-symbols-rounded") {
        speedOptions.classList.remove("show");
    }
});

function ecrant(){
    container.classList.toggle("fullscreen");
    h1.style.top = "-50vw";
    logo.style.width = "25%";
    if(document.fullscreenElement) {
        fullScreenBtn.classList.replace("fa-compress", "fa-expand");
        h1.style.top = "-22vw";
        logo.style.width = "35%";
        return document.exitFullscreen();
    }
    fullScreenBtn.classList.replace("fa-expand", "fa-compress");
    container.requestFullscreen();
}

fullScreenBtn.addEventListener("click", () => {
    ecrant()
});


function toogle(){
    const hideControls = () => {
        if(mainVideo.paused) return;
        timer = setTimeout(() => {
            container.classList.remove("show-controls");
        }, 20000);
    }
    hideControls();
        container.classList.add("show-controls");
        clearTimeout(timer);
        hideControls();   
}



document.addEventListener("keydown", function(event) {
    console.log(event.key)

    // barre echape
    if (event.key === "Escape") {
        ecrant()
        toogle()
    }
    if (event.key === "f"){
        ecrant()
        toogle()
    }


    // volume touche
    if (event.key === "ArrowUp") {
        mainVideo.volume += 0.1;
        volumeSlider.value = mainVideo.volume;
        volumeBtn.classList.replace("fa-volume-xmark", "fa-volume-high");
        toogle()

    }if(event.key === "ArrowDown"){
        mainVideo.volume -= 0.1;
        volumeSlider.value = mainVideo.volume;
        toogle()

    }



    // avancer de 10 seconde
    if(event.key === "ArrowRight"){
        mainVideo.currentTime += 10
        toogle()
    }
    if(event.key === "ArrowLeft"){
        mainVideo.currentTime -= 10
        toogle()
    }
    if (event.code === "Space") {
        if (mainVideo.paused) {
          mainVideo.play();
          console.log("play");
          toogle()
        } else {
          mainVideo.pause();
          console.log("pause");
          toogle()
        }
      }

  });


mainVideo.addEventListener('click', function(){
    if (mainVideo.paused) {
        mainVideo.play();
        console.log("play");
        toogle()
      } else {
        mainVideo.pause();
        console.log("pause");
        toogle()
      }
  });

  
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let i = 1;
h1.innerText = tbl[0][0];
p.innerText = "episode "+ i + " saison 1";

next.addEventListener('click', function(){
    i += 1;
    if(i <= tbl[0][1]){
        mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
        p.innerText = "episode "+ i + " saison 1";
        
    }else{
        mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
        p.innerText = "episode "+ i + " saison 1";
    } 
   
});

button2.addEventListener('click', function(){
    i += 1;
    if(i <= tbl[0][1]){
        mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
        p.innerText = "episode "+ i + " saison 1";
        
    }else{
        mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
        p.innerText = "episode "+ i + " saison 1";
    }
   
});

prev.addEventListener('click', function(){
    
    if(i <= 1){
        i -= 1;
        i = tbl[0][1]
        mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
        p.innerText = "episode "+ i + " saison 1";
        mainVideo.currentTime = 0;
        
    }else{
        i -= 1;
        mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
        p.innerText = "episode "+ i + " saison 1";
        mainVideo.currentTime = 0;
        
    }
   
});

let progresBarSwitch = document.getElementById("progress");
button2.style.display = "none"
progresBarSwitch.style.display = 'none'
let intervalId;
let messageEnvoye = false;

function nextepauto(){
    if (mainVideo.paused) {
        return;
    }
    
    if (mainVideo.currentTime >= 1290 && !messageEnvoye) {
        button2.style.display = "block";
        progresBarSwitch.style.display = 'block'

        toogle()
        
    
        messageEnvoye = true;
    
        intervalId = setTimeout(function() {
            i += 1;
            if (i <= tbl[0][1]) {
                mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
                p.innerText = "episode "+ i + " saison 1";
            } else {
                mainVideo.src = "assets/videos/Kimetsu.no.Yaiba.E0"+i+".FRENCH.1080p.WEB.x264-RiPiT.mkv.mp4";
                p.innerText = "episode "+ i + " saison 1";
            }
            
            mainVideo.currentTime = 0;
            messageEnvoye = false;
            button2.style.display = "none";
            progresBarSwitch.style.display = 'none'

        }, 10000);
          
    } else if (mainVideo.currentTime < 1290 && messageEnvoye) {
        clearTimeout(intervalId);
        messageEnvoye = false;
        button2.style.display = "none";
        progresBarSwitch.style.display = 'none'
    }


}

mainVideo.addEventListener("timeupdate", function() {
    nextepauto()

});




window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
gtag('js', new Date());

gtag('config', 'UA-166000335-1');

speedBtn.addEventListener("click", () => speedOptions.classList.toggle("show"));
pipBtn.addEventListener("click", () => mainVideo.requestPictureInPicture());
skipBackward.addEventListener("click", () => mainVideo.currentTime -= 10);
skipForward.addEventListener("click", () => mainVideo.currentTime += 10);
mainVideo.addEventListener("play", () => playPauseBtn.classList.replace("fa-play", "fa-pause"));
mainVideo.addEventListener("pause", () => playPauseBtn.classList.replace("fa-pause", "fa-play"));
playPauseBtn.addEventListener("click", () => mainVideo.paused ? mainVideo.play() : mainVideo.pause());
videoTimeline.addEventListener("mousedown", () => videoTimeline.addEventListener("mousemove", draggableProgressBar));
document.addEventListener("mouseup", () => videoTimeline.removeEventListener("mousemove", draggableProgressBar));