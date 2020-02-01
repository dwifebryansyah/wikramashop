@extends('layouts.element.login_main')

@section('title', 'Sign Up')

@section('content')
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Silahkan Daftar</h2>
                    <form action="{{ route('regiter.process') }}" method="POST" class="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" autofocus name="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="role_id"><i class="zmdi zmdi-accounts"></i></label>
                            <select name="role_id" class="form-control" style="padding: 6px 30px; border: none; border-bottom: 1px solid #999; font-size: 13px; color:black;">
                                <option value="">Pilih Role</option>
                                @foreach ($roles as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <button type="submit" disabled id="signup" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('/assets/login/images/signup-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('signIn') }}" class="signup-image-link">I am already have account</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#agree-term').on('click', function(){
                var cek = $('#agree-term:checked');
                if(cek.length == 1){
                    $('#signup').prop('disabled', false);
                }else{
                    $('#signup').prop('disabled', true);
                }
            })

        });
    </script>
@endsection
