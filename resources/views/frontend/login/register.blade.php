<div class="col-sm-4">
    <div class="signup-form">
        <!--sign up form-->
        <h2>New User Signup!</h2>
        <form action="{{ route('frontend.register') }}" method="post" class="form_class">
            @csrf

            <input type="text" name="name" placeholder="Name" value="{{ old('names') }}">
            <input type="email" id="email_register" name="email" placeholder="Email " value="{{ old('email') }}">
            <div class="error_email"></div>
            <input type="password" name="password" placeholder="Password" value="{{ old('password') }}">
            <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">

            <label>Select Country</label>
            <div>
                <select
                    class="js-example-placeholder-single js-states form-control @error('country_id') is-invalid @enderror"
                    name="country_id">
                    <option></option>
                    @foreach($country as $key)
                    <option value="{{ $key['id'] }}">{{ $key['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <p style="color: red">
                @error('country_id')
                {{ $message }}
                @enderror
            </p>
    </div>
    <button type="submit" class="btn btn-default">Signup</button>
    </form>
</div>
<!--/sign up form-->
</div>
