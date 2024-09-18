document.getElementById('name').addEventListener('input', function () {
    const name = this.value;
    const nameFeedback = document.getElementById('nameFeedback');
    const nameIcon = document.getElementById('nameIcon');
    if (name.length >= 2) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        nameFeedback.style.color = 'green';
        nameIcon.style.color = 'green';
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        nameFeedback.style.color = 'red';
        nameIcon.style.color = 'red';
    }
});

// Surname validation function
document.getElementById('surname').addEventListener('input', function () {
    const surname = this.value;
    const surnameFeedback = document.getElementById('surnameFeedback');
    const surnameIcon = document.getElementById('surnameIcon');
    if (surname.length >= 2) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        surnameFeedback.style.color = 'green';
        surnameIcon.style.color = 'green';
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        surnameFeedback.style.color = 'red';
        surnameIcon.style.color = 'red';
    }
});

// Email validation function
document.getElementById('email').addEventListener('input', function () {
    const email = this.value;
    const emailPattern = /^[^\s@]+@redberry\.ge$/;
    const emailFeedback = document.getElementById('emailFeedback');
    const emailIcon = document.getElementById('emailIcon');
    if (emailPattern.test(email)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        emailFeedback.style.color = 'green';
        emailIcon.style.color = 'green';

    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        emailFeedback.style.color = 'red';
        emailIcon.style.color = 'red';
    }
});

// Phone phone validation function
document.getElementById('phone').addEventListener('input', function () {
    const phone = this.value;
    const phoneFeedback = document.getElementById('phoneFeedback');
    const phoneIcon = document.getElementById('phoneIcon');
    if (/^\d+$/.test(phone)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        phoneFeedback.style.color = 'green';
        phoneIcon.style.color = 'green';
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        phoneFeedback.style.color = 'red';
        phoneIcon.style.color = 'red';
    }
});

document.getElementById('imageUpload').addEventListener('change', function () {
    const fileInput = this;
    const uploadArea = document.getElementById('uploadArea');
    const uploadedImage = document.getElementById('uploadedImage');
    const imageFeedback = document.getElementById('imageFeedback');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadedImage.src = e.target.result;
            uploadedImage.style.display = 'block';
        }
        reader.readAsDataURL(fileInput.files[0]);

        uploadArea.style.borderColor = 'green';
        imageFeedback.style.color = 'green';
    } else {
        uploadArea.style.borderColor = 'red';
        imageFeedback.style.color = 'red';
        uploadedImage.style.display = 'none';
    }

});