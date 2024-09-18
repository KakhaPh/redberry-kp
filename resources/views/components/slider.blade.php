{{-- Property Infinity Slider --}}
<h1 class="title">ბინები მსგავსს ლოკაციაზე</h1>

<div class="property_slider">
    <div class="wrapper">
        <i class="fas fa-arrow-left" id="left"></i>
        <ul class="carousel">
            @foreach($SliderRealEstates as $SliderRealEstate)
            <li class="card">
                <a href="{{ route('real-estates.show', $SliderRealEstate['id']) }}" data-region-id="{{ $SliderRealEstate['city']['region']['id'] }}"></a>
                <div class="rent_buy">{{ $SliderRealEstate['is_rental'] == '1' ? 'ქირავდება' : 'იყიდება'}}</div>
                <img src="{{ $SliderRealEstate['image'] }}" alt="Image of {{ $SliderRealEstate['address'] }}">
                <div class="slider_all_text">
                    <span class="slider_property_price">{{ number_format($SliderRealEstate['price']) }} ₾</span>
                    <div class="slider_property_address"><i class="fa-solid fa-location-dot"></i> {{ $SliderRealEstate['address']}} </div>
                    <div class="slider_property_description">
                        <div class="slider_property_bedrooms"><i class="fa-solid fa-bed"></i> <span> {{ $SliderRealEstate['bedrooms'] }}</span> </div>
                        <div class="slider_property_area"><i class="fa-solid fa-expand"></i> <span> {{ $SliderRealEstate['area'] }} მ²</span> </div>
                        <div class="slider_property_vector"><i class="fa-solid fa-sign-hanging"></i> <span> {{ $SliderRealEstate['zip_code'] }}</span> </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <i class="fas fa-arrow-right" id="right"></i>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/property_slider.js') }}"></script>
@endpush