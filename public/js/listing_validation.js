// document.querySelector('form').addEventListener('submit', function (event) {
//     const isSelected = document.querySelector('input[name="is_rental"]:checked');
//     const errorMessage = document.getElementById('radio-error');

//     if (!isSelected) {
//         event.preventDefault();
//         errorMessage.style.display = 'block';
//         window.scrollTo({ top: 0, behavior: 'smooth' });
//     } else {
//         errorMessage.style.display = 'none';
//     }
// });

document.getElementById('address').addEventListener('input', function (event) {
    const address = this.value;
    const addressFeedback = document.getElementById('addressFeedback');
    const addressIcon = document.getElementById('addressIcon');
    if (address.length >= 2) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        addressFeedback.style.color = 'green'
        addressIcon.style.color = 'green'
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        addressFeedback.style.color = 'red'
        addressIcon.style.color = 'red'
    }
});

document.getElementById('zipcode').addEventListener('input', function (event) {
    const zipcode = this.value;
    const zipcodeFeedback = document.getElementById('zipcodeFeedback');
    const zipcodeIcon = document.getElementById('zipcodeIcon')
    if (/^\d+$/.test(zipcode)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        zipcodeFeedback.style.color = 'green'
        zipcodeIcon.style.color = 'green'
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        zipcodeFeedback.style.color = 'red'
        zipcodeIcon.style.color = 'red'
    }
});

document.getElementById('price').addEventListener('input', function (event) {
    const price = this.value;
    const priceFeedback = document.getElementById('priceFeedback');
    const priceIcon = document.getElementById('priceIcon')
    if (/^\d+$/.test(price)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        priceFeedback.style.color = 'green'
        priceIcon.style.color = 'green'
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        priceFeedback.style.color = 'red'
        priceIcon.style.color = 'red'
    }
});

document.getElementById('area').addEventListener('input', function (event) {
    const area = this.value;
    const areaFeedback = document.getElementById('areaFeedback');
    const areaIcon = document.getElementById('areaIcon')
    if (/^\d+$/.test(area)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        areaFeedback.style.color = 'green'
        areaIcon.style.color = 'green'
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        areaFeedback.style.color = 'red'
        areaIcon.style.color = 'red'
    }
});

document.getElementById('bedrooms').addEventListener('input', function (event) {
    const bedrooms = this.value;
    const bedroomsFeedback = document.getElementById('bedroomsFeedback');
    const bedroomsIcon = document.getElementById('bedroomsIcon')
    if (/^\d+$/.test(bedrooms)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        bedroomsFeedback.style.color = 'green'
        bedroomsIcon.style.color = 'green'
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        bedroomsFeedback.style.color = 'red'
        bedroomsIcon.style.color = 'red'
    }
});

document.getElementById('describe').addEventListener('input', function (event) {
    const describe = this.value;
    const describeFeedback = document.getElementById('describeFeedback');
    const describeIcon = document.getElementById('describeIcon');

    if (describe.split(/\s+/).filter(Boolean).length >= 5) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        describeFeedback.style.color = 'green';
        describeIcon.style.color = 'green';
    } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        describeFeedback.style.color = 'red';
        describeIcon.style.color = 'red';
    }
});

document.getElementById('agent').addEventListener('change', function () {
    const agent = this.value;
    const agentFeedback = document.getElementById('agentFeedback');
    const agentIcon = document.getElementById('agentIcon');

    if (agent === '') {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        agentFeedback.style.color = 'red';
        agentIcon.style.color = 'red';
    } else {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
        agentFeedback.style.color = 'green';
        agentIcon.style.color = 'green';
    }
});

document.getElementById('imageUpload').addEventListener('change', function () {
    const fileInput = this;
    const uploadArea = document.getElementById('uploadArea');
    const uploadedImage = document.getElementById('uploadedImage');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadedImage.src = e.target.result;
            uploadedImage.style.display = 'block';
        }
        reader.readAsDataURL(fileInput.files[0]);

        uploadArea.style.borderColor = 'green';
    } else {
        uploadArea.style.borderColor = 'red';
        uploadedImage.style.display = 'none';
    }
});

// Form submission validation
document.querySelector('form').addEventListener('submit', function (event) {
    let isValid = true;

    const isSelected = document.querySelector('input[name="is_rental"]:checked');
    const radioErrorMessage = document.getElementById('radio-error');
    if (!isSelected) {
        isValid = false;
        radioErrorMessage.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        radioErrorMessage.style.display = 'none';
    }

    const address = document.getElementById('address').value;
    if (address.length < 2) {
        isValid = false;
        document.getElementById('addressFeedback').style.color = 'red';
        document.getElementById('addressIcon').style.color = 'red';
    }

    const zipcode = document.getElementById('zipcode').value;
    if (!/^\d+$/.test(zipcode)) {
        isValid = false;
        document.getElementById('zipcodeFeedback').style.color = 'red';
        document.getElementById('zipcodeIcon').style.color = 'red';
    }

    const price = document.getElementById('price').value;
    if (!/^\d+$/.test(price)) {
        isValid = false;
        document.getElementById('priceFeedback').style.color = 'red';
        document.getElementById('priceIcon').style.color = 'red';
    }

    const area = document.getElementById('area').value;
    if (!/^\d+$/.test(area)) {
        isValid = false;
        document.getElementById('areaFeedback').style.color = 'red';
        document.getElementById('areaIcon').style.color = 'red';
    }

    const bedrooms = document.getElementById('bedrooms').value;
    if (!/^\d+$/.test(bedrooms)) {
        isValid = false;
        document.getElementById('bedroomsFeedback').style.color = 'red';
        document.getElementById('bedroomsIcon').style.color = 'red';
    }

    const describe = document.getElementById('describe').value;
    if (describe.split(/\s+/).filter(Boolean).length < 5) {
        isValid = false;
        document.getElementById('describeFeedback').style.color = 'red';
        document.getElementById('describeIcon').style.color = 'red';
    }

    const agent = document.getElementById('agent').value;
    if (agent === '') {
        isValid = false;
        document.getElementById('agentFeedback').style.color = 'red';
        document.getElementById('agentIcon').style.color = 'red';
    }

    const fileInput = document.getElementById('imageUpload');
    const uploadArea = document.getElementById('uploadArea');
    const imageError = document.getElementById('imageError');
    if (!fileInput.files || fileInput.files.length === 0) {
        event.preventDefault();
        uploadArea.style.borderColor = 'red';
        imageError.style.color = 'red';
    }

    if (!isValid) {
        event.preventDefault();
    }
});