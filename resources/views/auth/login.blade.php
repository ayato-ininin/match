<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>
        <div class='signinPage'>
  <div class='container'>
    <div class='userIcon'>
      <i class="fas fa-user fa-3x"></i>
    </div>
    <h2 class="title">ログイン</h2>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group @error('email')has-error @enderror">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required placeholder="メールアドレスを入力してください" autofocus />
                @error('email')
               <span class="errorMessage">
                {{ $message }}
                </span>
                @enderror
            </div>

            <div class="mt-4 form-group @error('password')has-error @enderror">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="current-password" placeholder="パスワードを入力してください"/>
                @error('password')
             <span class="errorMessage">
              {{ $message }}
               </span>
              @enderror
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="address form-group items-center mt-4 text-center">
                @if (Route::has('password.request'))
                <a class="address underline text-sm text-gray-600 hover:text-gray-900 block text-center" href="{{ route('register') }}">
                    {{ __('アカウント作成') }}
                </a>
                    <a class="address underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    <br>
                    
                @endif

                <x-jet-button class="ml-4 btnlog">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
        </div>
</div>
    </x-jet-authentication-card>
</x-guest-layout>