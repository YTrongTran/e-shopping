@extends('frontend.layouts.master')
@section('title')
<title>Login | E-Shopper</title>
@endsection
@section('css')
@endsection

@section('content')

<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{ route('frontend.login') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                        <input type="password" name="password" placeholder="Password Address"
                            value="{{ old('password') }}">
                        <span>
                            <input type="checkbox" name="remember_me" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            @include('frontend.login.register')
        </div>
    </div>
</section>

@endsection

@section('js')
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="{{ asset('jquery.js') }}"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).ready(function(){

        $("#email_register").on('change',function(){
            let email = $(this).val();
            let url = '{{ route("frontend.login.register") }}';

            $.ajax({
                url : url,
                type : "GET",
                dateType: 'json',
                data:{
                    'email_register': email
                },
                success:function(data){
                    var html_to_append = '';
                    if(data['code'] == 200 && data.email != null)
                    {

                        html_to_append += '<p style="color:red;"> Email này đã tồn tại: '+data.email['email']+'. Vui lòng nhập địa chỉ Email khác </p>';

                            $(".error_email").html(html_to_append);
                        }else{
                        html_to_append += '<p style="color:green;">Bạn có thể sử dụng email này</p>';

                        $(".error_email").html(html_to_append);

                    }

                }
            });
        });
    });
</script>
@endsection
