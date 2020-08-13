
function resizeImage(img) {

    const W = parseInt(img.width / 4);
    const H = parseInt(img.height / 4);

    const canvas = document.createElement("canvas");
    canvas.width = W;
    canvas.height = H;

    const ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, W, H);

    const resizedImg = new Image();
    resizedImg.src = canvas.toDataURL('image/jpeg', 1);
    document.body.append(resizedImg);

}

function handleFiles(e) {

    for (const file of this.files) {

        const img = document.createElement("img");
        const reader = new FileReader();

        reader.addEventListener("load", (e) => {
            img.addEventListener("load", (e) => {
                resizeImage(img);
            });
            img.src = e.target.result;
        });

        reader.readAsDataURL(file);

    }

}

const fileInput = document.getElementById("file-input");

fileInput.addEventListener("change", handleFiles, false);
