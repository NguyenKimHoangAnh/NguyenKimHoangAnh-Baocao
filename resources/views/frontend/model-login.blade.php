<div class="containers">

<div class="forms-container">
    <div class="signin-signup">
        <form action="{{ route('site.postlogin') }}" method="post" class="forms sign-in-form">
            @csrf

            <h2 class="title-sign">Sign in</h2>
            <div class="input-field-sign">
                <i class="fas fa-user"></i>
                <input name="username" type="text" placeholder="Username" />
            </div>
            <div class="input-field-sign">
                <i class="fas fa-lock"></i>
                <input name="password" type="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn-sign solid" />
            @if (isset($error))
                <div class="mt-3">
                    <div class="text-danger text-center ">
                        {{ $error }}
                    </div>
                </div>
            @endif
            <p class="social-text-sign">Or Sign in with social platforms</p>
            <div class="social-media-sign">
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </form>
        <form action="{{ route('site.postlogin') }}" method="post" class="forms sign-up-form">
            @csrf
            <h2 class="title-sign">Sign up</h2>

            <div class="input-field-sign">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field-sign">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" />
            </div>

            <input type="submit" class="btn-sign" value="Sign up" />
            @if (isset($error))
                <div class="mt-3">
                    <div class="text-danger text-center ">
                        {{ $error }}
                    </div>
                </div>
            @endif
            <p class="social-text-sign">Or Sign up with social platforms</p>
            <div class="social-media-sign">
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="social-icon-sign">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="panels-container">
    <div class="panel-sign left-panel-sign">
        <div class="content-sign">
            <h3>New here ?</h3>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                ex ratione. Aliquid!
            </p>
            <button class="btn-sign transparent-sign sign-up-btn " id="">
                Sign up
            </button>
        </div>
        <img src="img/log.svg" class="image-sign" alt="" />
    </div>
    <div class="panel-sign right-panel-sign">
        <div class="content-sign">
            <h3>One of us ?</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                laboriosam ad deleniti.
            </p>
            <button class="btn-sign transparen-sign sign-in-btn " id="">
                Sign in
            </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
    </div>
</div>

</div> 
<section class="forms-section">

<div class="forms">
    <div class="form-wrapper is-active">
        <button type="button" class="switcher switcher-login">
            Login
            <span class="underline"></span>
        </button>
        <form action="{{ route('site.postlogin') }}" method="post" class="form form-login">
            @csrf

            <fieldset>
                <legend>Please, enter your email and password for login.</legend>
                <div class="input-block">
                    <label for="login-email">Username</label>
                    <input id="login-email" name="username" type="text" required>
                </div>
                <div class="input-block">
                    <label for="login-password">Password</label>
                    <input id="login-password" name="password" type="password" required>
                </div>
            </fieldset>
            @if (isset($error))
                <div class="mt-3">
                    <div class="text-danger text-center ">
                        {{ $error }}
                    </div>
                </div>
            @endif
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
    <div class="form-wrapper">
        <button type="button" class="switcher switcher-signup">
            Sign Up
            <span class="underline"></span>
        </button>
        <form action="{{ route('frontend.login') }}" method="post" class="form form-signup">
            @csrf

            <fieldset>
                <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                <div class="input-block">
                    <label for="signup-username">Username</label>
                    <input id="signup-username" name="username" type="email" required>
                </div>
                <div class="input-block">
                    <label for="signup-email">E-mail</label>
                    <input id="signup-email" name="email" type="email" required>
                </div>
                <div class="input-block">
                    <label for="signup-password">Password</label>
                    <input id="signup-password" name="password" type="password" required>
                </div>
                <div class="input-block">
                    <label for="signup-password-confirm">Confirm password</label>
                    <input id="signup-password-confirm" name="confirm_password" type="password" required>
                </div>
            </fieldset>
            <button type="submit" class="btn-signup">SignUp</button>
        </form>
    </div>
</div>
</section>
