<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login_signup.css">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="assets/images/signup.jpeg" alt="Sign Up Image" class="image">
        </div>
        <div class="form-container">
            <h1 class="font">LOGIN</h1>
            <form method="post" action="SecurityLoginVerify" id="signup">
                @csrf
                <div class="form-group">
                    <label for="phoneno" class="font">Phone Number</label>
                    <input type="text" name="phoneno" id="rollno" placeholder="Phone Number" required>
                    @if($errors->has('phoneno'))
                        <span class="text-danger">{{ $errors->first('phoneno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="font">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <a href="" class="font" style="font-size:14px;">Forgot Password?</a>
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Login">
                </div>
                <!-- <div class="text-below-image">Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></div> -->
            </form>
        </div>
    </div>
</body>
</html>