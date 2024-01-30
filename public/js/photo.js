const width = 640, height = 480;
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
const captureBtn = document.getElementById('captureBtn');
const downloadLink = document.getElementById('downloadLink');

let video = null, isSetup = false;

Setup();

function Setup() {
    if (!isSetup) {
        canvas.width = width;
        canvas.height = height;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        canvas.style.backgroundColor = 'green';

        video = document.getElementById('camera');
        document.addEventListener('click', TakePhoto);

        navigator.mediaDevices
            .getUserMedia({video: true, audio: false})
            .then((stream) => {
                video.srcObject = stream;
                video.play();
            })
            .catch((error) => {
                console.error(`Error obtaining video stream:\n${error}`);
            });

        isSetup = true;
    }
}

function TakePhoto(e) {
    e.preventDefault();
    ctx.drawImage(video, 0, 0, width, height);
    const imageData = canvas.toDataURL('image/png');

    let formData = new FormData();
    formData.append('imageData', imageData);

    let options = {
        method: 'POST',
        body: formData
    };

    fetch('imagerecieve.php', options)
    .then(async (response) => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then((data) => {
        if (data.success) {
            console.log('Photo saved successfully.');
            downloadLink.href = data.photoURL;
            downloadLink.style.display = 'block';
            downloadLink.setAttribute('download', 'photo.png');
        } else {
            console.error('Failed to save photo.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

