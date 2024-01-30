const width = 640, height = 480;
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
const captureBtn = document.getElementById('captureBtn');
const downloadLink = document.getElementById('downloadLink');

let video = null, isSetup = false;

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

            // wanneer je klikt op het groene canvas maak je een foto
            video = document.getElementById('camera');
            document.addEventListener('click', TakePhoto);

            // pak video
            navigator.mediaDevices
                .getUserMedia({video: true, audio: false})
                .then((stream)=>{
                    video.srcObject = stream;
                    video.play();
                }).catch((error)=>{
                    console.error(`Error obtaining video stream:\n$(error)`)
                })

        isSetup = true;
    }
}

function TakePhoto(e) {
    e.preventDefault();
    ctx.drawImage(video, 0, 0, width, height);
}
