<x-layout_plain>
    <x-slot name="title">
        <title>Register Form</title>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <!-- Sign up form -->
            <section class="signup">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" class="@error('name') is-invalid @enderror" name="name"
                                    id="name" placeholder="Your Name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" class="@error('email') is-invalid @enderror" name="email"
                                    id="email" placeholder="Your Email" value="{{ old('email') }}" required
                                    autocomplete="email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-account material-icons-phone"></i></label>
                                <input type="text" class="@error('phone') is-invalid @enderror" name="phone"
                                    id="phone" placeholder="Your Phone" value="{{ old('phone') }}" required
                                    autocomplete="phone" autofocus />
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="text" class="@error('password') is-invalid @enderror" name="password"
                                    id="pass" placeholder="Your Password" value="{{ old('password') }}" required
                                    autocomplete="password" autofocus />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="re_pass"
                                    placeholder="Repeat your password" required autocomplete="new-password" />
                            </div>

                            <div class="form-group form-button">
                                <button type="submit" class="form-submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('images/signup-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-layout_plain>
