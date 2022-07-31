@extends('user.layouts.user')

@section('title')
    سبد خرید
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">آدرس ها</h4>
                        </div>

                        <div class="col-lg-12 col-md-12 mt-3">



                            @foreach ($addresses as $address)
                                <div>
                                    <address>
                                        <p>
                                            <strong>
                                                نام کاربر :
                                                {{ auth()->user()->name == null ? auth()->user()->phone_number : auth()->user()->name }}
                                            </strong>
                                            <br>
                                            <span class="mr-2"> عنوان آدرس : <span>
                                                    {{ $address->title }}
                                                </span> </span>
                                        </p>
                                        <p>
                                            {{ $address->address }}
                                            <br>
                                            <span> استان : {{ state_name($address->state_id) }}
                                            </span>
                                            <br>
                                            <span> شهر : {{ city_name($address->city_id) }} </span>
                                        </p>
                                        <p>
                                            کدپستی :
                                            {{ $address->postal_code }}
                                        </p>
                                        <p>
                                            شماره موبایل :
                                            {{ $address->phone_number }}
                                        </p>

                                    </address>
                                    <a data-toggle="collapse" href="#collapse-address-{{ $address->id }}"
                                        class="check-btn sqr-btn btn btn-warning">
                                        <i class="sli sli-pencil"></i>
                                        ویرایش آدرس
                                    </a>

                                    <div id="collapse-address-{{ $address->id }}" class="collapse mt-3"
                                        style="{{ count($errors->addressUpdate) > 0 && $errors->addressUpdate->first('address_id') == $address->id ? 'display:block' : '' }}">
                                        <form
                                            action="{{ route('user.users_profile.addresse.update', ['address' => $address->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">

                                                <div class="form-group tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        عنوان
                                                    </label>
                                                    <input class="form-control" type="text" name="title"
                                                        value="{{ $address->title }}">
                                                    @error('title', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="form-group tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شماره تماس
                                                    </label>
                                                    <input class="form-control" type="text" name="phone_number"
                                                        value="{{ $address->phone_number }}">
                                                    @error('phone_number', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="form-group tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        استان
                                                    </label>
                                                    <select class="form-control email s-email s-wid state-select"
                                                        name="state_id">
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}"
                                                                {{ $state->id == $address->state_id ? 'selected' : '' }}>
                                                                {{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('state_id', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="form-group tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شهر
                                                    </label>
                                                    <select class="form-control email s-email s-wid city-select"
                                                        name="city_id">
                                                        <option value="{{ $address->city_id }}" selected>
                                                            {{ city_name($address->city_id) }}
                                                        </option>
                                                    </select>
                                                    @error('city_id', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="form-group tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        آدرس
                                                    </label>
                                                    <input class="form-control" type="text" name="address"
                                                        value="{{ $address->address }}">
                                                    @error('address', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="form-group tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        کد پستی
                                                    </label>
                                                    <input class="form-control" type="text" name="postal_code"
                                                        value="{{ $address->postal_code }}">
                                                    @error('postal_code', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12">

                                                    <button class=" btn btn-success" type="submit"> ثبت آدرس
                                                    </button>
                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                                <hr>
                            @endforeach

                            <button class="collapse-address-create mt-3 btn btn-info" onclick="toggle_visibility()"> ایجاد
                                آدرس
                                جدید </button>
                            <div id="add-address" class="collapse-address-create-content mt-3"
                                style="{{ count($errors->addressStore) > 0 ? 'display:block' : 'display:none' }}">

                                <form action="{{ route('user.users_profile.addresse.store') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="form-group tax-select col-lg-6 col-md-6">
                                            <label>
                                                عنوان
                                            </label>
                                            <input class="form-control" type="text" name="title"
                                                value="{{ old('title') }}">
                                            @error('title', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group tax-select col-lg-6 col-md-6">
                                            <label>
                                                شماره تماس
                                            </label>
                                            <input class="form-control" type="text" name="phone_number"
                                                value="{{ old('phone_number') }}">
                                            @error('phone_number', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group tax-select col-lg-6 col-md-6">
                                            <label>
                                                استان
                                            </label>
                                            <select class="form-control email s-email s-wid state-select" name="state_id">
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state_id', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group tax-select col-lg-6 col-md-6">
                                            <label>
                                                شهر
                                            </label>
                                            <select class="form-control email s-email s-wid city-select" name="city_id">
                                            </select>
                                            @error('city_id', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group tax-select col-lg-6 col-md-6">
                                            <label>
                                                آدرس
                                            </label>
                                            <input class="form-control" type="text" name="address"
                                                value="{{ old('address') }}">
                                            @error('address', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group tax-select col-lg-6 col-md-6">
                                            <label>
                                                کد پستی
                                            </label>
                                            <input class="form-control" type="text" name="postal_code"
                                                value="{{ old('postal_code') }}">
                                            @error('postal_code', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">

                                            <button class="btn btn-success" type="submit"> ثبت آدرس
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript-code')
    <script>
        $('.state-select').change(function() {

            var stateID = $(this).val();

            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/user-profile/get-state-cities-list') }}?state_id=" + stateID,
                    success: function(res) {
                        if (res) {
                            $(".city-select").empty();

                            $.each(res, function(key, city) {
                                console.log(city);
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });

                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });

        function toggle_visibility() {
            var x = document.getElementById("add-address");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection
