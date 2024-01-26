<!DOCTYPE html>
<html lang="en">
<head>
    <title>CryptoMarkerCap | {{$pageTitle}}</title>
    <!-- <link rel="stylesheet" href="reset.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="custom/css/head.css">
    <link rel="stylesheet" href="custom/css/auth.css">
    <script src="custom/js/auth.js"></script>
    <!--Stylesheet-->
</head>

<body>
    <div class="auth-container" >
        <div id="auth-nav" class="d-flex">
            <a class="flex-fill text-dark text-decoration-none login {{$action==='login'? 'active': ''}}" href="{{url('login')}}"><h4 class="fw-bold">Login</h4></a>
            <a class="flex-fill text-dark text-decoration-none signup {{$action==='login'? '': 'active'}}" href="{{url('signup')}}"><h4 class="fw-bold">Sign up</h4></a>
        </div>
        <form id="frm_auth" method="post" action="{{url('/'.$action.'ok')}}">
            @csrf
            <h6>{{$action==='login'? "Welcome back" : "Let's start"}}</h6>
            <h4 class="fw-bold">{{$action==='login'? "Login here" : "Sign up now"}}</h4>

            <div class="coolinput email">
                <label for="email" class="text control-label">Email</label>
                <input type="text" placeholder="Enter your email..." class="input" id="email" name="email">
            </div>

            <div class="coolinput password">
                <label for="password" class="text">Password</label>
                <input type="text" placeholder="Enter password..." class="input" id="password" name="password">
            </div>

            @if($action === 'login')
                <div class="float-end text-secondary">
                    Quên mật khẩu?
                </div>
            @else
                <div class="coolinput password-confirm">
                    <label for="passwordConfirm" class="text">Password Confirm</label>
                    <input type="text" placeholder="Enter password..." class="input" id="passwordConfirm" name="passwordConfirm">
                </div>
                {{--<div class="d-flex" width=380px>
                    <input type="checkbox" name="agree" id="agree" class="align-top">
                    <label for="agree">Please keep me updated by email with the latest crypto news, research findings, reward programs, event updates, coin listings and more information from CoinMarketCap.</label>
                </div>--}}
            @endif

            <div class="frm_button">
                <button type="submit" value="Submit">{{$pageTitle}}</button>
            </div>
            {{--<div class="social">
            <div class="go"><i class="fab fa-google"></i>  Google</div>
            <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
            </div>--}}
            <input type="hidden" id="action" name="action" value="{{$action}}">
        </form>
    </div>
</body>
</html>
