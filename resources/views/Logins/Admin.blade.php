<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/login_signup.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid custom-navbar">
          <img class="logo" src="assets/images/logo.webp" alt="logo">
        </div>
    </nav>
    <div class="login-container">
        <div class="image-container">
            <img class="image" src="assets/images/faculty.webp" alt="Sign Up Image" width="800px">
        </div>
        <div class="form-container">
            <h1 class="heading font">ADMIN LOGIN</h1>
            <form method="post" action="/AdminLoginVerify" id="signup">
                @csrf
                <div class="form-group">
                    @if (Session::get('success'))
                        <span class="text-safe" role="alert">
                            {{ Session::get('success') }}
                        </span>
                    @endif
                    <label for="email" class="font labels">E-Mail</label>
                    <input class="inputs" type="text" name="email" id="email" placeholder="Enter e-mail" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group password-container">
                    <label for="password" class="font labels">Password</label>
                    <input class="inputs" type="password" id="password" name="password" placeholder="Enter password" required>
                    <span class="password-toggle-icon"><i class="fas fa-eye"style="padding-top: 30px"></i></span>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <a href="{{ route('reset_pass_admin') }}" class="font" style="font-size:14px; text-decoration:none;">Forgot Password?</a>
                </div>
                <div class="form-group button">
                    <input class="submit-btn" type="submit" id="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
    <script>
        const passwordField = document.getElementById("password");
        const togglePassword = document.querySelector(".password-toggle-icon i");

        togglePassword.addEventListener("click", function () {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        }
        });
    </script>
</body>
</html>