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
                                {{ __('Meus dados') }}
                            </h2>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div class="mb-2">
                                <label for="name" class="text-dark">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
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
                                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
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
                                            {{ __('E-mail não verificado.') }}

                                            <button form="send-verification" class="btn btn-primary">
                                                {{ __('Clique aqui para reenviar o e-mail.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p>
                                                {{ __('Uma nova verificação foi enviada para seu e-mail.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="flex centralizar mt-3">
                                <button type="submit" class="btn btn-custom">{{ __('Salvar') }}</button>

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
                   
                    <div class="container">
                        <div class="mb-3">
                            <h2 class="text-dark">
                                {{ __('Alterar Senha') }}
                            </h2>
                        </div>
                   
            
                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div class="mb-2">
                                <label for="update_password_current_password" class="text-dark">{{ __('Current Password') }}</label>
                                <input id="update_password_current_password" name="current_password" type="password"  class="form-control"  autocomplete="current-password">
                                @if ($errors->updatePassword->has('current_password'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->updatePassword->get('current_password') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label for="update_password_password" class="text-dark">{{ __('New Password') }}</label>
                                <input id="update_password_password" name="password" type="password"  class="form-control"  autocomplete="new-password">
                                @if ($errors->updatePassword->has('password'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->updatePassword->get('password') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label for="update_password_password_confirmation" class="text-dark">{{ __('Confirm Password') }}</label>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control"  autocomplete="new-password">
                                @if ($errors->updatePassword->has('password_confirmation'))
                                    <ul class="mt-2 text-sm text-red-600">
                                        @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="flex items-center centralizar gap-4">
                                <button type="submit" class="btn btn-custom">{{ __('Salvar') }}</button>

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
