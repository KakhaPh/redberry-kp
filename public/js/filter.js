document.addEventListener('DOMContentLoaded', function () {
    const regionFilterButton = document.getElementById('region-filter-button');
    const priceFilterButton = document.getElementById('price-filter-button');
    const areaFilterButton = document.querySelector('.area-filter-button');
    const checkboxes = document.querySelectorAll('.select_regions input[type="checkbox"]');
    const realEstates = document.querySelectorAll('.property_information');
    const choosenDetails = document.querySelector('.choosen_details');
    const fromInput = document.getElementById('price-from');
    const uptoInput = document.getElementById('price-upto');
    const areaFromInput = document.getElementById('area-from');
    const areaUptoInput = document.getElementById('area-upto');
    const minPriceDivs = document.querySelectorAll('.min_price div');
    const maxPriceDivs = document.querySelectorAll('.max_price div');
    const minAreaDivs = document.querySelectorAll('.min_area div');
    const maxAreaDivs = document.querySelectorAll('.max_area div');
    const bedroomFilterButton = document.getElementById('bedroom-filter-button');
    const bedroomDivs = document.querySelectorAll('.bedroom_quantity');
    let selectedBedrooms = null;

    const savedRegions = JSON.parse(localStorage.getItem('selectedRegions')) || [];
    const savedPriceFilter = JSON.parse(localStorage.getItem('priceFilter')) || { from: 0, upto: Infinity };
    const savedAreaFilter = JSON.parse(localStorage.getItem('areaFilter')) || { from: 0, upto: Infinity };
    const savedBedroomsFilter = JSON.parse(localStorage.getItem('selectedBedrooms')) || null;


    // Set initial state based on saved data
    if (savedBedroomsFilter) {
        bedroomDivs.forEach(div => {
            if (div.getAttribute('data-bedroom') === savedBedroomsFilter) {
                div.classList.add('active');
                selectedBedrooms = savedBedroomsFilter;
            }
        });
    }

    // Add click event listeners to minimum price divs
    minPriceDivs.forEach(div => {
        div.addEventListener('click', function () {
            const price = div.textContent.replace(/₾/g, '').replace(/,/g, '').trim();
            fromInput.value = price; // Set value to minimum price input
        });
    });

    // Add click event listeners to maximum price divs
    maxPriceDivs.forEach(div => {
        div.addEventListener('click', function () {
            const price = div.textContent.replace(/₾/g, '').replace(/,/g, '').trim();
            uptoInput.value = price; // Set value to maximum price input
        });
    });

    // Add click event listeners to minimum area divs
    minAreaDivs.forEach(div => {
        div.addEventListener('click', function () {
            const area = div.textContent.replace(/მ²/g, '').replace(/,/g, '').trim();
            areaFromInput.value = area; // Set value to minimum area input
        });
    });

    // Add click event listeners to maximum area divs
    maxAreaDivs.forEach(div => {
        div.addEventListener('click', function () {
            const area = div.textContent.replace(/მ²/g, '').replace(/,/g, '').trim();
            areaUptoInput.value = area; // Set value to maximum area input
        });
    });

    // Add click event listeners to bedroom quantity divs
    bedroomDivs.forEach(div => {
        div.addEventListener('click', function () {
            const bedroomCount = div.getAttribute('data-bedroom');
            if (selectedBedrooms === bedroomCount) {
                selectedBedrooms = null;
                div.classList.remove('active');
            } else {
                selectedBedrooms = bedroomCount;
                div.classList.add('active');
            }
        });
    });

    // Add click event listener to bedroom filter button
    bedroomFilterButton.addEventListener('click', function () {
        applyFilter();
    });

    choosenDetails.addEventListener('click', function (event) {
        if (event.target.classList.contains('fa-x')) {
            const filterType = event.target.getAttribute('data-filter-type');

            if (filterType === 'bedrooms') {
                selectedBedrooms = null;
                // Remove the choosen_bedrooms div
                event.target.parentElement.remove();
                applyFilter();
            }
        }
    });

    checkboxes.forEach(checkbox => {
        checkbox.checked = savedRegions.includes(checkbox.value);
    });

    fromInput.value = savedPriceFilter.from > 0 ? savedPriceFilter.from : '';
    uptoInput.value = savedPriceFilter.upto < Infinity ? savedPriceFilter.upto : '';
    areaFromInput.value = savedAreaFilter.from > 0 ? savedAreaFilter.from : '';
    areaUptoInput.value = savedAreaFilter.upto < Infinity ? savedAreaFilter.upto : '';

    // Function to apply the filter
    function applyFilter() {
        let anyResultFound = false;

        const selectedRegions = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        const fromPrice = parseFloat(fromInput.value.replace(/,/g, '')) || 0;
        const uptoPrice = parseFloat(uptoInput.value.replace(/,/g, '')) || Infinity;

        const fromArea = parseFloat(areaFromInput.value.replace(/,/g, '')) || 0;
        const uptoArea = parseFloat(areaUptoInput.value.replace(/,/g, '')) || Infinity;

        realEstates.forEach(realEstate => {
            const regionId = realEstate.getAttribute('data-region-id');
            const price = parseFloat(realEstate.querySelector('.property_price').textContent.replace(/₾/g, '').replace(/,/g, ''));
            const area = parseFloat(realEstate.querySelector('.property_area').textContent.replace(/მ²/g, '').replace(/,/g, ''));
            const bedrooms = parseInt(realEstate.querySelector('.property_bedrooms span').textContent);

            // Filter by region, price, and area
            const matchesRegion = selectedRegions.length === 0 || selectedRegions.includes(regionId);
            const matchesPrice = price >= fromPrice && price <= uptoPrice;
            const matchesArea = area >= fromArea && area <= uptoArea;
            const matchesBedrooms = !selectedBedrooms || (selectedBedrooms && (selectedBedrooms === '5' ? bedrooms >= 5 : bedrooms == selectedBedrooms));

            if (matchesRegion && matchesPrice && matchesArea && matchesBedrooms) {
                realEstate.style.display = 'block';
                anyResultFound = true;
            } else {
                realEstate.style.display = 'none';
            }
        });

        const noPropertiesMessage = document.querySelector('.no-properties');
        if (anyResultFound) {
            noPropertiesMessage.classList.add('d-none');
        } else {
            noPropertiesMessage.classList.remove('d-none');
            noPropertiesMessage.classList.add('d-flex');
        }

        // Save selected regions, price, and area filters to localStorage
        localStorage.setItem('selectedRegions', JSON.stringify(selectedRegions));
        localStorage.setItem('priceFilter', JSON.stringify({ from: fromPrice, upto: uptoPrice }));
        localStorage.setItem('areaFilter', JSON.stringify({ from: fromArea, upto: uptoArea }));
        localStorage.setItem('selectedBedrooms', selectedBedrooms); // Save bedroom selection

        // Update the chosen regions and filters display
        updateChosenDetails(selectedRegions, fromPrice, uptoPrice, fromArea, uptoArea, selectedBedrooms);
    }

    // Function to update chosen filters display
    function updateChosenDetails(selectedRegions, fromPrice, uptoPrice, fromArea, uptoArea, selectedBedrooms) {
        choosenDetails.innerHTML = ''; // Clear previous details

        // Display chosen regions
        selectedRegions.forEach(regionId => {
            const regionName = [...checkboxes].find(checkbox => checkbox.value === regionId).nextElementSibling.textContent;
            const regionDiv = document.createElement('div');
            regionDiv.classList.add('chsn_dtls', 'choosen_region');
            regionDiv.innerHTML = `${regionName} <i class="fa-solid fa-x" data-region-id="${regionId}"></i>`;
            choosenDetails.appendChild(regionDiv);
        });

        // Display chosen price range if it is not the default
        if (fromPrice > 0 || uptoPrice < Infinity) {
            const priceDiv = document.createElement('div');
            priceDiv.classList.add('chsn_dtls', 'choosen_price');
            priceDiv.innerHTML = `${fromPrice ? fromPrice + '₾' : ''} - ${uptoPrice < Infinity ? uptoPrice + '₾' : 'მდე'} <i class="fa-solid fa-x" data-filter-type="price"></i>`;
            choosenDetails.appendChild(priceDiv);
        }

        // Display chosen area range if it is not the default
        if (fromArea > 0 || uptoArea < Infinity) {
            const areaDiv = document.createElement('div');
            areaDiv.classList.add('chsn_dtls', 'choosen_area');
            areaDiv.innerHTML = `${fromArea ? fromArea + 'მ²' : ''} - ${uptoArea < Infinity ? uptoArea + 'მ²' : 'მდე'} <i class="fa-solid fa-x" data-filter-type="area"></i>`;
            choosenDetails.appendChild(areaDiv);
        }

        // Display chosen bedrooms if any
        if (selectedBedrooms) {
            const bedroomDiv = document.createElement('div');
            bedroomDiv.classList.add('chsn_dtls', 'choosen_bedrooms');
            bedroomDiv.innerHTML = `საძინებლები: ${selectedBedrooms === '5' ? '5+' : selectedBedrooms} <i class="fa-solid fa-x" data-filter-type="bedrooms"></i>`;
            choosenDetails.appendChild(bedroomDiv);
        }

        // Add event listeners to the fa-x icons for other filters
        choosenDetails.querySelectorAll('i.fa-x[data-filter-type="price"]').forEach(icon => {
            icon.addEventListener('click', function () {
                fromInput.value = '';
                uptoInput.value = '';
                applyFilter();
            });
        });

        choosenDetails.querySelectorAll('i.fa-x[data-filter-type="area"]').forEach(icon => {
            icon.addEventListener('click', function () {
                areaFromInput.value = '';
                areaUptoInput.value = '';
                applyFilter();
            });
        });

        choosenDetails.querySelectorAll('i.fa-x[data-region-id]').forEach(icon => {
            icon.addEventListener('click', function () {
                const regionId = icon.getAttribute('data-region-id');
                document.querySelector(`.select_regions input[type="checkbox"][value="${regionId}"]`).checked = false;
                applyFilter();
            });
        });

        if (selectedRegions.length > 0 || fromPrice > 0 || uptoPrice < Infinity || fromArea > 0 || uptoArea < Infinity || selectedBedrooms) {
            // Create the "Clear All Filters" span if choosen_details has items
            if (!document.querySelector('.choosen_details .clear')) {
                createClearFiltersSpan();
            }
        } else {
            // Remove the "Clear All Filters" span if choosen_details is empty
            const existingClearSpan = choosenDetails.querySelector('.clear');
            if (existingClearSpan) {
                existingClearSpan.remove();
            }
        }

        function createClearFiltersSpan() {
            const clearSpan = document.createElement('span');
            clearSpan.classList.add('clear');
            clearSpan.textContent = 'გასუფთავება'; // Change this to the text you want
            choosenDetails.appendChild(clearSpan);

            clearSpan.addEventListener('click', function () {
                // Clear all filters
                document.querySelectorAll('.select_regions input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
                document.getElementById('price-from').value = '';
                document.getElementById('price-upto').value = '';
                document.getElementById('area-from').value = '';
                document.getElementById('area-upto').value = '';
                document.querySelectorAll('.bedroom_quantity').forEach(div => div.classList.remove('active'));

                // Clear localStorage
                localStorage.removeItem('selectedRegions');
                localStorage.removeItem('priceFilter');
                localStorage.removeItem('areaFilter');
                localStorage.removeItem('selectedBedrooms');

                applyFilter();

                // Clear chosen details display
                updateChosenDetails([], 0, Infinity, 0, Infinity, null);
                location.reload()
            });
        }
    }


    // Add event listeners to filter buttons
    regionFilterButton.addEventListener('click', applyFilter);
    priceFilterButton.addEventListener('click', applyFilter);
    areaFilterButton.addEventListener('click', applyFilter);
    bedroomFilterButton.addEventListener('click', applyFilter);

    // Initial filter application
    applyFilter();
});
