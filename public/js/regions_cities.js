document.addEventListener('DOMContentLoaded', function () {
    const regionSelect = document.getElementById('region_id');
    const citySelect = document.getElementById('city_id');

    // Fetch and populate regions
    fetch('https://api.real-estate-manager.redberryinternship.ge/api/regions')
        .then(response => response.json())
        .then(data => {
            data.forEach(region => {
                const option = document.createElement('option');
                option.value = region.id;
                option.textContent = region.name;
                regionSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching regions:', error));

    // Fetch and populate cities based on selected region
    regionSelect.addEventListener('change', function () {
        const selectedRegionId = this.value;

        // Clear current city options
        citySelect.innerHTML = '<option value="">Select City</option>';

        if (selectedRegionId) {
            fetch('https://api.real-estate-manager.redberryinternship.ge/api/cities')
                .then(response => response.json())
                .then(data => {
                    const cities = data.filter(city => city.region_id == selectedRegionId);
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching cities:', error));
        }
    });
});