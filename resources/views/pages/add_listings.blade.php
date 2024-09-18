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

    @if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
    @endif
    <div class="listings_container">
        <h3 class="text-center font-weight-bold listing_title">ლისტინგის დამატება</h3>
        <form id="addListings" class="pt-5" action="{{ route('real-estates.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h6 class="pt-3 pb-3 font-weight-bold">გარიგების ტიპი *</h6>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input type="radio" id="radio1" class="form-check-input" name="is_rental" value="1" required>
                    <label class="form-check-label listing_label" for="radio1">ქირავდება</label>
                </div>
                <div class="form-check form-check-inline pb-3">
                    <input type="radio" id="radio2" class="form-check-input" name="is_rental" value="0" required>
                    <label class="form-check-label listing_label" for="radio2">იყიდება</label>
                </div>
                <span id="radio-error" class="radioError"><i id="radioIcon" class="fa-solid fa-check"></i> გთხოვთ შეავსოთ
                    ველი</span>
            </div>


            <h6 class="pt-5 font-weight-bold">მდებარეობა</h6>
            <div class="form-row pb-3">
                <div class="form-group col-md-6">
                    <label for="address">მისამართი *</label>
                    <input type="text" id="address" class="form-control" name="address" required>
                    <span id="addressFeedback"><i id="addressIcon" class="fa-solid fa-check"></i> მინიმუმ 2 სიმბოლო</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="zip_code">საფოსტო ინდექსი *</label>
                    <input type="text" id="zipcode" class="form-control" name="zip_code" required>
                    <span id="zipcodeFeedback"><i id="zipcodeIcon" class="fa-solid fa-check"></i> მხოლოდ რიცხვები</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="region_id">რეგიონი</label>
                    <select id="region_id" class="form-control" name="region_id" required>
                        <option value="" disabled selected>აირჩიეთ რეგიონი</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="city_id">ქალაქი</label>
                    <select id="city_id" class="form-control" name="city_id" required>
                        <option value="" disabled selected>აირჩიეთ ქალაქი</option>
                    </select>
                </div>
            </div>

            <h6 class="pt-4 font-weight-bold">ბინის დეტალები</h6>
            <div class="form-row pb-3">
                <div class="form-group col-md-6">
                    <label for="price">ფასი *</label>
                    <input type="number" id="price" class="form-control" name="price" required>
                    <span id="priceFeedback"><i id="priceIcon" class="fa-solid fa-check"></i> მხოლოდ რიცხვები</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="area">ფართობი *</label>
                    <input type="number" id="area" class="form-control" name="area" step="0.1" required>
                    <span id="areaFeedback"><i id="areaIcon" class="fa-solid fa-check"></i> მხოლოდ რიცხვები</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bedrooms">საძინებლების რაოდენობა *</label>
                    <input type="number" id="bedrooms" class="form-control" name="bedrooms" required>
                    <span id="bedroomsFeedback"><i id="bedroomsIcon" class="fa-solid fa-check"></i> მხოლოდ რიცხვები</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="description">აღწერა *</label>
                    <textarea id="describe" name="description" rows="5"></textarea>
                    <span id="describeFeedback"><i id="describeIcon" class="fa-solid fa-check"></i> მინიმუმ 5 სიტყვა</span>
                </div>
            </div>

            <div class="form-row pb-2">
                <div class="form-group col-md-12">
                    <label for="image" class="form-label">ატვირთეთ სურათი *</label>
                    <div class="image-upload-wrapper" id="uploadArea">
                        <span class="placeholder-text"><i id="imageError" class="fa-solid fa-circle-plus"></i></span>
                        <img id="uploadedImage" alt="Uploaded Image">
                        <input type="file" name="image" id="imageUpload" accept="image/*" required>
                    </div>
                </div>
            </div>

            <h6 class="pt-4 font-weight-bold">აგენტი</h6>
            <div class="form-row pb-5">
                <div class="form-group col-md-12">
                    <label for="agent_id">აირჩიე</label>
                    <select id="agent" class="form-control col-md-6" name="agent_id" required>
                        <option value="" disabled selected>აირჩე</option>
                        @foreach($agents as $agent)
                        <option value="{{ $agent['id'] }}">{{ $agent['name'].' '.$agent['surname'] }}</option>
                        @endforeach
                    </select>
                </div>
                <span id="agentFeedback"><i id="agentIcon" class="fa-solid fa-check"></i> გთხოვთ აირჩიეთ აგენტი</span>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn add_agents mx-2" data-dismiss="modal">გაუქმება</button>
                <button type="submit" class="btn add_listings mx-2">დაამატე ლისტინგი</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/listing_validation.js') }}"></script>
    <script src="{{ asset('js/upload_image.js') }}"></script>
    <script src="{{ asset('js/regions_cities.js')}}"></script>
@endpush