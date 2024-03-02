@extends('layouts.starlight')
@section('content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Meal <img src="{{ asset('starlight/img/logo.png') }}" alt="" class="thumbnail img-responsive" style="max-width:17%;" srcset=""> <span class="tx-info tx-normal">Deal</span></div>
      <div class="tx-center mg-b-60">Estimate Your Daily Meal With MealDeal</div>

      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <input id="email" type="text"  class="form-control" placeholder="Enter your Email" name='email' required>
          </div><!-- form-group -->
          <div class="form-group">
            <input  id="password" type="password" class="form-control" placeholder="Enter your password" name="password" required>
            <a href="{{ route('password.request') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
          </div><!-- form-group -->
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
          {{-- @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror --}}
          <button type="submit" class="btn btn-info btn-block">Sign In</button>
      </form>

      <div class="mg-t-60 tx-center">Not yet a member? <a href="{{ url('register') }}" class="tx-info">Register Now</a></div>
    </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection
{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
