@extends('layout.app')

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="about_property">
        <div class="search_n_details">
            <div class="details_forall">
                <span class="detail_title">რეგიონი </span>
                <span class="arrow_up_down"> <i class="fa-solid fa-angle-down"></i></span>
                <div class="dropdown_content">
                    <div class="check_regions">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">რეგიონის მიხედვით</h6>
                                <div class="row">
                                    <div
                                        class="col-12 d-flex text-start justify-content-start flex-start align-items-start flex-wrap">
                                        @foreach($regions as $region)
                                        <div class="form-check select_regions">
                                            <div class="d-flex flex-column align-items-start">
                                                <input class="form-check-input" type="checkbox" value="{{ $region['id'] }}"
                                                    id="check_region{{ $region['id'] }}">
                                                <label class="form-check-label" for="check_region{{ $region['id'] }}">{{
                                                    $region['name'] }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="region-filter-button" class="btn add_listings mx-2">არჩევა</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details_forall">
                <span class="detail_title">საფასო კატეგორია </span>
                <span class="arrow_up_down"> <i class="fa-solid fa-angle-down"></i></span>
                <div class="dropdown_content">
                    <div class="check_price">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">ფასის მიხედვით</h6>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <div class="form-group mr-2 price-input-wrapper">
                                            <div class="input-container">
                                                <input type="text" class="form-control" id="price-from" placeholder="დან">
                                            </div>
                                        </div>
                                        <div class="form-group price-input-wrapper">
                                            <div class="input-container">
                                                <input type="text" class="form-control" id="price-upto" placeholder="მდე">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around pb-3">
                            <div class="min_price">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">მინ.ფასი</h6>
                                <div class="price_min_1">50,000 ₾</div>
                                <div class="price_min_2">100,000 ₾</div>
                                <div class="price_min_3">150,000 ₾</div>
                                <div class="price_min_4">250,000 ₾</div>
                                <div class="price_min_5">300,000 ₾</div>
                            </div>
                            <div class="max_price">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">მაქს.ფასი</h6>
                                <div class="price_max_1">50,000 ₾</div>
                                <div class="price_max_2">100,000 ₾</div>
                                <div class="price_max_3">150,000 ₾</div>
                                <div class="price_max_4">250,000 ₾</div>
                                <div class="price_max_5">300,000 ₾</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="price-filter-button" class="btn add_listings mx-2">არჩევა</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details_forall">
                <span class="detail_title">ფართობი </span>
                <span class="arrow_up_down"> <i class="fa-solid fa-angle-down"></i></span>
                <div class="dropdown_content">
                    <div class="check_area">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">ფართობის მიხედვით</h6>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <div class="form-group mr-2 area-input-wrapper">
                                            <div class="input-container">
                                                <input type="text" class="form-control" id="area-from" placeholder="დან">
                                            </div>
                                        </div>
                                        <div class="form-group area-input-wrapper">
                                            <div class="input-container">
                                                <input type="text" class="form-control" id="area-upto" placeholder="მდე">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around pb-3">
                            <div class="min_area">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">მინ. მ²</h6>
                                <div class="area_min_1">50 მ²</div>
                                <div class="area_min_2">100 მ²</div>
                                <div class="area_min_3">150 მ²</div>
                                <div class="area_min_4">250 მ²</div>
                                <div class="area_min_5">300 მ²</div>
                            </div>
                            <div class="max_area">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">მაქს. მ²</h6>
                                <div class="area_max_1">50 მ²</div>
                                <div class="area_max_2">100 მ²</div>
                                <div class="area_max_3">150 მ²</div>
                                <div class="area_max_4">250 მ²</div>
                                <div class="area_max_5">300 მ²</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn add_listings area-filter-button mx-2">არჩევა</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details_forall">
                <span class="detail_title">საძინებლების რაოდენობა </span>
                <span class="arrow_up_down"> <i class="fa-solid fa-angle-down"></i></span>
                <div class="dropdown_content">
                    <div class="check_bedrooms">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h6 class="d-flex justify-content-start font-weight-bold pb-2">საძინებლების რაოდენობა</h6>
                                <div class="row">
                                    <div class="bedroom_quantity" data-bedroom="1">1</div>
                                    <div class="bedroom_quantity" data-bedroom="2">2</div>
                                    <div class="bedroom_quantity" data-bedroom="3">3</div>
                                    <div class="bedroom_quantity" data-bedroom="4">4</div>
                                    <div class="bedroom_quantity" data-bedroom="5">5+</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" id="bedroom-filter-button" class="btn add_listings mx-2">არჩევა</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="listing_agents">
            <a class="add_listings" href="{{ route('add_listings') }}"><i class="fa-solid fa-plus"></i> ლისტინგის
                დამატება</a>
            <button type="button" class="btn add_agents" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                    class="fa-solid fa-plus"></i> აგენტის დამატება</button>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-5">
                        <h4 class="mt-3 font-weight-bold text-center">აგენტის დამატება</h4>
                        <form method="POST" action="{{ route('agent.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="name" class="form-label font-weight-bold">სახელი *</label>
                                    <input type="text" id="name" class="form-control" name="name" required>
                                    <span id="nameFeedback"><i id="nameIcon" class="fa-solid fa-check"></i> მინიმუმ 2
                                        სიმბოლო</span>
                                </div>
                                <div class="col">
                                    <label for="surname" class="form-label font-weight-bold">გვარი *</label>
                                    <input type="text" id="surname" class="form-control" name="surname" required>
                                    <span id="surnameFeedback"><i id="surnameIcon" class="fa-solid fa-check"></i> მინიმუმ 2
                                        სიმბოლო</span>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="email" class="form-label font-weight-bold">ელ-ფოსტა *</label>
                                    <input type="email" id="email" class="form-control" name="email" required>
                                    <span id="emailFeedback"><i id="emailIcon" class="fa-solid fa-check"></i> გამოიყენეთ
                                        @redberry.ge ფოსტა</span>
                                </div>
                                <div class="col">
                                    <label for="phone" class="form-label font-weight-bold">ტელეფონის ნომერი *</label>
                                    <input type="text" id="phone" class="form-control" name="phone" required>
                                    <span id="phoneFeedback"><i id="phoneIcon" class="fa-solid fa-check"></i> მხოლოდ
                                        რიცხვები</span>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="imageUpload" class="form-label font-weight-bold">ატვირთეთ სურათი *</label>
                                <div class="image-upload-wrapper" id="uploadArea">
                                    <span class="placeholder-text"><i class="fa-solid fa-circle-plus"></i></span>
                                    <img id="uploadedImage" alt="Uploaded Image">
                                    <input type="file" id="imageUpload" name="avatar" accept="image/*" required>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn add_agents mx-2" data-dismiss="modal">გაუქმება</button>
                                <button type="submit" class="btn add_listings mx-2">დაამატე აგენტი</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="choosen_details"></div>

    <div class="properties">
        {{-- Preloader --}}
        <div class="preloader"></div>
        @if(empty($realEstates))
            <p class="d-flex justify-content-start w-100">აღნიშნული მონაცემებით განცხადება არ იძებნება</p>
        @else
            @foreach($realEstates as $realEstate)
            <a class="property_information" href="{{ route('real-estates.show', $realEstate['id']) }}"
                data-region-id="{{ $realEstate['city']['region']['id'] }}">
                <div class="rent_buy">{{ $realEstate['is_rental'] == '1' ? 'ქირავდება' : 'იყიდება'}}</div>
                <img src="{{ $realEstate['image'] }}" alt="Image of {{ $realEstate['address'] }}">
                <span class="property_price">{{ number_format($realEstate['price']) }} ₾</span>
                <div class="property_address"><i class="fa-solid fa-location-dot"></i> {{ $realEstate['address']}}</div>
                <div class="property_description">
                    <div class="property_bedrooms"><i class="fa-solid fa-bed"></i> <span>{{ $realEstate['bedrooms'] }}</span>
                    </div>
                    <div class="property_area"><i class="fa-solid fa-expand"></i> <span>{{ $realEstate['area'] }} მ²</span>
                    </div>
                    <div class="property_vector"><i class="fa-solid fa-sign-hanging"></i> <span>{{ $realEstate['zip_code']
                            }}</span> </div>
                </div>
            </a>
            @endforeach
        @endif
        <p class="no-properties d-none justify-content-start w-100">აღნიშნული მონაცემებით განცხადება არ იძებნება</p>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/upload_image.js')}}"></script>
    <script src="{{asset('js/modal_validation.js')}}"></script>
    <script src="{{asset('js/filter.js')}}"></script>
    <script src="{{asset('js/preload.js')}}"></script>
@endpush