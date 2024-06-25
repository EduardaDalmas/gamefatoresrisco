@extends('logged')

@section('page')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3 mb-5">
            <div class="card centralizar p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="mb-3">
                                <h2 class="text-dark">
                                    {{ __('Profile Information') }}
                                </h2>

                                <p>
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="text-dark">{{ __('Name') }}</label>
                                <input id="name" name="name" type="text" class="mt-1 block w-full form-input rounded-md shadow-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                @if ($errors->has('name'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->get('name') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div>
                                <label for="email" class="text-dark">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email" class="mt-1 block w-full form-input rounded-md shadow-sm" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                @if ($errors->has('email'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->get('email') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p>
                                            {{ __('Your email address is unverified.') }}

                                            <button form="send-verification" class="btn btn-primary">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p>
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-dark"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3 mb-5">
            <div class="card centralizar p-3">
                <div class="card-body">
                    <div class="mb-3">

                    <div class="container">
    
                        <div class="mb-3">
                            <h2 class="text-dark">
                                {{ __('Update Password') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </div>
                   
            
                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="update_password_current_password" class="text-dark">{{ __('Current Password') }}</label>
                                <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                @if ($errors->updatePassword->has('current_password'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->updatePassword->get('current_password') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div>
                                <label for="update_password_password" class="text-dark">{{ __('New Password') }}</label>
                                <input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                @if ($errors->updatePassword->has('password'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->updatePassword->get('password') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div>
                                <label for="update_password_password_confirmation" class="text-dark">{{ __('Confirm Password') }}</label>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                @if ($errors->updatePassword->has('password_confirmation'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
