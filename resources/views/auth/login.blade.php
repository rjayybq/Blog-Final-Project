<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <!-- Include external CSS libraries for styling -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: "Poppins", sans-serif;

                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                color: #333;
                margin: 0;
                padding: 0px 0;
                background-image: url("assets/images/login.jpg"); /* Define your gradient colors */
                background-size: cover; /* Optional: if you want to ensure the gradient covers the whole screen */
                background-repeat: no-repeat; /* Optional: ensures the gradient doesn't repeat */
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }
            .card {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                padding: 2rem;
                width: 100%;
                max-width: 400px;
                margin: 1rem;
            }
            .card-header {
                font-size: 1.75rem;
                font-weight: 600;
                margin-bottom: 1rem;
                text-align: center;
                color: #333;
            }
            .form-group {
                margin-bottom: 1rem;
                text-align: center;
            }
            .form-control {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 0.75rem 1rem;
                font-size: 1rem;
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
                transition: border-color 0.3s ease;
            }
            .form-control:focus {
                border-color: #4e54c8;
                outline: none;
                box-shadow: 0 0 0 1px #4e54c8;
            }
            .btn-primary {
                background-color: #4e54c8;
                border: none;
                color: #fff;
                padding: 0.75rem;
                font-size: 1rem;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
                transition: background-color 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #3b44a8;
            }
            .btn-link {
                color: #4e54c8;
                font-size: 0.875rem;
                text-decoration: none;
                display: block;
                text-align: center;
                margin-top: 1rem;
            }
            .btn-link:hover {
                text-decoration: underline;
            }
            .form-check {
                margin-bottom: 1rem;
                text-align: center;
            }
            .form-check-label {
                font-size: 0.875rem;
            }
            .additional-links {
                text-align: center;
                margin-top: 1rem;
            }
            .additional-links a {
                color: #4e54c8;
                text-decoration: none;
            }
            .additional-links a:hover {
                text-decoration: underline;
            }
            .logo-container {
                display: flex;
                justify-content: center; /* Center horizontally */
                align-items: center; /* Center vertically if needed */
                margin-bottom: 20px; /* Add space below the logo if needed */
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/logorm.png') }}" alt="Logo" class="logo" style="width: 100px; height: auto;" />
                </div>
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                        @if (Route::has('password.request'))
                        <div class="additional-links">
                            <a class="btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                            <p>Don't have an account? <a href="{{ route('register') }}">Register here.</a></p>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <!-- Include external JS libraries if needed -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
