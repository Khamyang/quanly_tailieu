<style>
.wra form {
    /* height: 167px; */
    padding: 20px;
    display: flex;
    cursor: pointer;
    margin: 30px 0;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border-radius: 5px;
    border: 2px dashed #6990F2;
}


</style>
<div class="wrapper wra">
    <form action="#">
        <input class="file-input" type="file" name="file" hidden>
        <i class="fas fa-cloud-upload-alt"></i>
        <p>Browse File to Upload</p>
    </form>
    <section class="progress-area"></section>
    <section class="uploaded-area"></section>
</div>
<script>
const form = document.querySelector("form"),
    fileInput = document.querySelector(".file-input"),
    progressArea = document.querySelector(".progress-area"),
    uploadedArea = document.querySelector(".uploaded-area");

form.addEventListener("click", () => {
    fileInput.click();
});

fileInput.onchange = ({
    target
}) => {
    let file = target.files[0];
    if (file) {
        let fileName = file.name;
        if (fileName.length >= 12) {
            let splitName = fileName.split('.');
            fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
        }
        uploadFile(fileName);
    }
}
function uploadFile(name) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/tai_tep_tin_len.php");
    xhr.upload.addEventListener("progress", ({
        loaded,
        total
    }) => {
        let fileLoaded = Math.floor((loaded / total) * 100);
        let fileTotal = Math.floor(total / 1000);
        let fileSize;
        (fileTotal < 1024) ? fileSize = fileTotal + " KB": fileSize = (loaded / (1024 * 1024)).toFixed(2) +
            " MB";
        let progressHTML = `<li class="row">
                          <i class="fas fa-file-alt"></i>
                          <div class="content">
                            <div class="details">
                              <span class="name">${name} • Uploading</span>
                              <span class="percent">${fileLoaded}%</span>
                            </div>
                            <div class="progress-bar">
                              <div class="progress" style="width: ${fileLoaded}%"></div>
                            </div>
                          </div>
                        </li>`;
        uploadedArea.classList.add("onprogress");
        progressArea.innerHTML = progressHTML;
        if (loaded == total) {
            progressArea.innerHTML = "";
            let uploadedHTML = `<li class="row">
                            <div class="content upload">
                              <i class="fas fa-file-alt"></i>
                              <div class="details">
                                <span class="name">${name} • Uploaded</span>
                                <span class="size">${fileSize}</span>
                              </div>
                            </div>
                            <i class="fas fa-check"></i>
                          </li>`;
            uploadedArea.classList.remove("onprogress");
            uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
        }
    });
    let data = new FormData(form);
    xhr.send(data);
}
</script>