@extends('site.user_dashboard.dashboard')

@section('tab-title') Edit Address @endsection

@section('tab-pane-content')
    <!-- Address Section -->
    <div class="tab-pane fade show active">
        <div class="card">
            <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">Edit Address</div>
            <div class="card-body">
                <form id="addressForm" action="{{ route('user-dashboard.address.update') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="address_id" value="{{ $address->id }}">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input name="first_name" id="first_name" placeholder="First name"
                                value="{{ $address->billing_first_name }}" class="form-control" type="text" required>
                            <small class="text-danger" id="first_name_error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <input name="last_name" id="last_name" placeholder="Last name"
                                value="{{ $address->billing_last_name }}" class="form-control" type="text" required>
                            <small class="text-danger" id="last_name_error"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input name="email" id="email" placeholder="Email address"
                                class="form-control" value="{{ $address->billing_email }}" type="email" required>
                            <small class="text-danger" id="email_error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <input name="phone" id="phone" placeholder="Phone number"
                                class="form-control" value="{{ $address->billing_phone_number }}" type="tel" required>
                            <small class="text-danger" id="phone_error"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="country_id">Country:</label>
                            <select id="country_id" name="country" required class="custom-select">
                                <option value="" disabled>Choose...</option>
                                @foreach($countrys as $country)
                                    <option value="{{ $country->id }}" @if($address->billing_country == $country->id) selected @endif>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="country_error"></small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="states_id">State:</label>
                            <select id="states_id" name="state" required class="custom-select">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" @if($address->billing_state == $state->id) selected @endif>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="state_error"></small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="citys_id">City:</label>
                            <select id="citys_id" name="city" required class="custom-select">
                                <option value="">Select City</option>
                                @foreach($citys as $city)
                                    <option value="{{ $city->id }}" @if($address->billing_city == $city->id) selected @endif>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="city_error"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address:</label>
                            <textarea rows="3" name="address" id="address" placeholder="Street address..."
                                    class="form-control">{{ $address->billing_address }}</textarea>
                            <small class="text-danger" id="address_error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pincode">Pin Code:</label>
                            <input name="pincode" id="pincode" placeholder="Post code / Zip"
                                value="{{ $address->billing_zip_code }}" class="form-control" type="number" required>
                            <small class="text-danger" id="pincode_error"></small>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-info"><span>Update Address</span></button>
                    </div>
                </form>

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
    });

    // On submit validation
    $("#addressForm").on("submit", function (e) {
        let valid = true;

        $("#first_name, #last_name, #email, #phone, #pincode, #country_id, #states_id, #citys_id, #address").each(function () {
            const id = $(this).attr("id");
            const val = $(this).val().trim();

            // Trigger keyup validation for all fields
            $(this).keyup();

            if (val === "") {
                $("#" + id + "_error").text("This field is required.");
                valid = false;
            }
        });

        // Final checks
        if (!validateName($("#first_name").val()) ||
            !validateName($("#last_name").val()) ||
            !validateEmail($("#email").val()) ||
            !validatePhone($("#phone").val()) ||
            !validatePincode($("#pincode").val())) {
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            alert("Please correct the errors before submitting.");
        }
    });
});
</script>
@endsection
