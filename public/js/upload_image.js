const imageUpload = document.getElementById('imageUpload');
const uploadedImage = document.getElementById('uploadedImage');
const uploadArea = document.getElementById('uploadArea');
const placeholderText = document.querySelector('.placeholder-text');

uploadArea.addEventListener('click', () => {
    imageUpload.click();
});

imageUpload.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadedImage.src = e.target.result;
            uploadedImage.style.display = 'block';
            placeholderText.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});