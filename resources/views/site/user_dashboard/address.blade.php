@extends('site.user_dashboard.dashboard')

@section('tab-title') Address @endsection

@section('tab-pane-content')
    <!-- Address Section -->
    <div class="tab-pane fade show active">
        <div class="card">
            <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">Address</div>
            <div class="card-body">
                <div class="row">
                    @if (!empty($addresses))
                        @foreach ($addresses as $addr)
                            {!! getAddressById($addr->id) !!}
                        @endforeach
                    @endif
                </div>

                <div class="accordion add-address mt-3" id="address1">
                    <button class="collapsed btn rounded sjkgjhgk" type="button" onclick="$('#billing').toggle(400);">Add New Address</button>
                    <div id="billing" class="card mb-4 mt-5 accordion-collapse collapse" data-bs-parent="#address" style="display: none;">
                        <form id="addAddressForm" action="{{ route('user-dashboard.address.save') }}" method="post" novalidate>
                            @csrf
                            <div class="">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Add New Address</h5>
                                </div>

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input name="first_name" id="first_name" placeholder="First name"
                                                value="{{ old('first_name') }}" class="form-control" type="text" required>
                                            <small class="text-danger" id="first_name_error"></small>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input name="last_name" id="last_name" placeholder="Last name"
                                                class="form-control" value="{{ old('last_name') }}" type="text" required>
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input name="email" id="email" placeholder="Email address"
                                                class="form-control" value="{{ old('email') }}" type="email" required>
                                            <small class="text-danger" id="email_error"></small>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input name="phone" id="phone" placeholder="Phone number"
                                                class="form-control" value="{{ old('phone') }}" type="tel" required>
                                            <small class="text-danger" id="phone_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="country_id">Country:</label>
                                            <select id="country_id" name="country" required class="custom-select">
                                                <option value="" selected disabled>Choose...</option>
                                                @foreach($countrys as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="country_error"></small>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="states_id">State:</label>
                                            <select id="states_id" name="state" required class="custom-select">
                                                <option value="">Select State</option>
                                            </select>
                                            <small class="text-danger" id="state_error"></small>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="citys_id">City:</label>
                                            <select id="citys_id" name="city" required class="custom-select">
                                                <option value="">Select City</option>
                                            </select>
                                            <small class="text-danger" id="city_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <textarea rows="3" name="address" id="address"
                                                placeholder="Street address. Apartment, suite, unit etc. (optional)"
                                                class="form-control">{{ old('address') }}</textarea>
                                        <small class="text-danger" id="address_error"></small>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input name="pincode" id="pincode" placeholder="Post code / Zip"
                                                value="{{ old('pincode') }}" class="form-control" type="text">
                                            <small class="text-danger" id="pincode_error"></small>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn border-btn">
                                        <span>Add Address</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    function validateName(name) {
        return /^[A-Za-z\s]+$/.test(name);
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function validatePhone(phone) {
        return /^[0-9]{10}$/.test(phone);
    }

    function validatePincode(pin) {
        return /^[0-9]{6}$/.test(pin);
    }

    // Realtime validation
    $("#first_name, #last_name, #email, #phone, #pincode").on("keyup blur", function () {
        const id = $(this).attr("id");
        const val = $(this).val().trim();
        let error = "";

        if (id === "first_name" || id === "last_name") {
            if (val === "") error = "This field is required.";
            else if (!validateName(val)) error = "Only letters are allowed.";
        } else if (id === "email") {
            if (val === "") error = "Email is required.";
            else if (!validateEmail(val)) error = "Invalid email address.";
        } else if (id === "phone") {
            if (val === "") error = "Phone number is required.";
            else if (!validatePhone(val)) error = "Phone must be 10 digits.";
        } else if (id === "pincode") {
            if (val === "") error = "Pincode is required.";
            else if (!validatePincode(val)) error = "Pincode must be 6 digits.";
        }

        $("#" + id + "_error").text(error);
        if (error) $(this).addClass("is-invalid");
        else $(this).removeClass("is-invalid");
    });

    // On submit validation
    $("#addAddressForm").on("submit", function (e) {
        let valid = true;

        $("#first_name, #last_name, #email, #phone, #pincode, #country_id, #states_id, #citys_id, #address").each(function () {
            const id = $(this).attr("id");
            const val = $(this).val().trim();

            if (val === "") {
                $("#" + id + "_error").text("This field is required.");
                $(this).addClass("is-invalid");
                valid = false;
            } else {
                $(this).removeClass("is-invalid");
            }
        });

        if (!validateName($("#first_name").val()) ||
            !validateName($("#last_name").val()) ||
            !validateEmail($("#email").val()) ||
            !validatePhone($("#phone").val()) ||
            !validatePincode($("#pincode").val())) {
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            alert("Please correct the highlighted errors before submitting.");
        }
    });
});
</script>
@endsection
