@extends('layout.base') @section('title', '登录') @section('body')
<div class="m-screen pt-10">
  <div class="w-full max-w-xs m-auto">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('login') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label class="form-label" for="email">
          {{ __("Email") }}
        </label>
        <input
          class="form-input @error('email') border-red-500 @enderror"
          id="email"
          name="email"
          type="email"
          placeholder="{{ __('Email') }}"
          value="{{ old('email') }}"
          required
        />
        @error('email')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label class="form-label" for="password">
          {{ __("Password") }}
        </label>
        <input
          class="form-input @error('password') border-red-500 @enderror"
          id="password"
          name="password"
          type="password"
          placeholder="******"
          value="{{ old('password') }}"
          required
        />
        @error('password')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="btn-primary" type="commit">
          {{ __("Login") }}
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          {{ __("Forgot Your Password?") }}
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
