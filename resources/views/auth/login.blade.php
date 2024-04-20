@extends('login-layouts.head')



<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="{{asset('login-assets/images/login.jpg')}}" alt="">
        <div class="text">
          <span class="text-1">“Crochet is a journey of creativity and self-expression.”</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="{{asset('images/login.jpg')}}" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="form">
            <div class="title">Login</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Signup</div>
        <form action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Register">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>

</body>
