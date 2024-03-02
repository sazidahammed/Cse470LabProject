@extends('layouts.starlight')
@section('content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

    <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Meal <img src="{{ asset('starlight/img/logo.png') }}" alt="" class="thumbnail img-responsive" style="max-width:17%;" srcset=""> <span class="tx-info tx-normal">Deal</span></div>
        <div class="tx-center mg-b-60">Estimate Your Daily Meal With MealDeal</div>
    <form  action="{{ route('register') }}" method="POST">
      @csrf
        <div class="form-group">
            <input type="text" id='company' class="form-control" placeholder="Enter your company name" name='company' required>
          </div><!-- form-group -->
          <div class="form-group">
            <select name='type' class="form-control" required>
                <option value="">-- Select Role --</option>
                <option value="91">Catering System</option>
                <option value="92">Bachelor Meal System</option>
            </select>
          </div><!-- form-group -->
          <div class="form-group">
            <input type="text" id="name" class="form-control" placeholder="Enter your name" name='name' required>
          </div><!-- form-group -->
          <div class="form-group">
            <input type="email" id="email" class="form-control" placeholder="Enter your email" name='email' required>
          </div><!-- form-group -->
          <div class="form-group">
            <input type="text" id="phone" class="form-control" placeholder="Enter your phone number" name='phone' required>
          </div><!-- form-group -->
          <div class="form-group">
            <input type="password" id="password" class="form-control" placeholder="Enter your password" name='password' required>
          </div><!-- form-group -->
          <div class="form-group">
            <input type="password" id="password_confirmation" class="form-control" placeholder="Enter your confirm password" name="password_confirmation" required >
          </div><!-- form-group -->
          <x-input-error :messages="$errors->get('company')" class="mt-2" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
          <x-input-error :messages="$errors->get('phone')" class="mt-2" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


          <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
          <button type="submit" class="btn btn-info btn-block">Sign Up</button>
    </form>
    <div class="mg-t-40 tx-center">Already have an account? <a href="{{ url('login') }}" class="tx-info">Sign In</a></div>

    </div><!-- login-wrapper -->

  </div><!-- d-flex -->

@endsection

@section('footer_script')
 <script>
    $(function(){
      'use strict';

      $('.select2').select2({
        minimumResultsForSearch: Infinity
      });
    });
  </script>
@endsection

{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- company -->
            <div>
                <x-input-label for="company" :value="__('Company Name')" />

                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required autofocus />

                <x-input-error :messages="$errors->get('company')" class="mt-2" />
            </div>
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- company -->
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />

                <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
