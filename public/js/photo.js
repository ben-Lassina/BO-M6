// Het canvas is 640 bij 480 groot, en haalt het element canvas op van de html
const width =  640, height = 480,
    canvas = document.getElementById("canvas"),
    ctx = canvas.getContext("2d");

let video = null, isSetup = false

Setup();
function Setup() {
    // if setup false als default, van lijn 5
    if(!isSetup) {
            canvas.width = width;
            canvas.height = height;
            //geen css aanmaken
            canvas.style.width = `$[width]px`;
            canvas.style.height = `$[height]px`;
            // het kan ook zo:
            // canvas.style.height = height + "px";
            canvas.style.backgroundColor = 'green';

            // wanneer je klikt op het groene canvas maak je een fot
            video = document.getElementById('camera');
            document.addEventListener('click', TakePhoto);

            // pak video
            navigator.mediaDevices
                .getUserMedia({video: true, audio: false})
                .then((stream)=>{
                    video.srcObject = stream;
                    video.play();
                }).catch((error)=>{
                    console.error(`Error obtaoning video stream:\n$(error)`)
                })

        isSetup != isSetup
    } 
}

//functie om een foto te nemen
function TakePhoto(e) {
    e.preventDefault();
    ctx.drawImage(video, 0, 0, width, height);
}