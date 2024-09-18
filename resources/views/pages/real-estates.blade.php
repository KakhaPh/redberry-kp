@extends('layout.app')

@section('content')
    <a class="arrow-left-a" href="{{ route('home') }}"><i class="fa-solid fa-arrow-left"></i></a></br></br>
    <div class="real_estate_div">
        <div class="real_estate_left">
            <img src="{{asset('storage/image_1.png')}}" alt="real_estate_img">
            <p class="upload_date">გამოქვეყნების თარიღი {{ \Carbon\Carbon::parse($realEstate['created_at'])->format('m/d/Y')
                }}</p>
        </div>
        <div class="real_estate_right">
            <div class="real_estate_price">{{ number_format($realEstate['price']) }} ₾</div>
            <div class="real_estate_address"><i class="fa-solid fa-location-dot"></i> {{
                $realEstate['city']['region']['name'] }}, {{ $realEstate['address'] }} </div>
            <div class="real_estate_description">
                <div class="real_estate_bedrooms"><i class="fa-solid fa-bed"></i> საძინებელი {{ $realEstate['bedrooms'] }}
                </div>
                <div class="real_estate_area"><i class="fa-solid fa-expand"></i> ფართი {{ $realEstate['area'] }} მ²</div>
                <div class="real_estate_vector"><i class="fa-solid fa-sign-hanging"></i> საფოსტო ინდექსი {{
                    $realEstate['zip_code'] }}</div>
            </div>

            <div class="real_estate_descr">
                {{ $realEstate['description'] }}
            </div>

            <div class="agent_container">
                <div class="agent_img_name pb-3">
                    <div class="agent_img_div">
                        <img src="{{ asset('storage/image_1.png') }}"
                            alt="Agent {{ $realEstate['agent']['name'] }} {{ $realEstate['agent']['surname'] }}"
                            class="agent_img">
                    </div>
                    <div class="agent_name_div">
                        <h2 class="agent_name">{{ $realEstate['agent']['name'] }} {{ $realEstate['agent']['surname'] }}</h2>
                        <p class="agent_details">აგენტი</p>
                    </div>
                </div>
                <p class="agent_details"><a href="mailto:{{ $realEstate['agent']['email'] }}"><i
                            class="fa-regular fa-envelope"></i> {{ $realEstate['agent']['email'] }}</a></p>
                <p class="agent_details"><a href="tel:{{ $realEstate['agent']['phone'] }}"><i class="fa-solid fa-phone"></i>
                        {{ $realEstate['agent']['phone'] }}</a></p>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn real_estate_delete_btn" data-toggle="modal" data-target="#exampleModalCenter"
                data-id="{{ $realEstate['id'] }}">
                ლისტინგის წაშლა
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center custom-color">
                            გსურთ წაშალოთ ლისტინგი?
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center pb-5">
                            <form id="delete-form" method="POST" action="" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn add_agents mx-2" data-dismiss="modal">გაუქმება</button>
                                <button type="submit" class="btn add_listings mx-2">დადასტურება</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.slider')

@endsection