<x-guest-layout>
    <div class="signupPage">
  <header class="header">
    <div>アカウントを作成</div>
  </header>
  <body>
      
 
  <div class='container'>
    <x-jet-authentication-card>
        
        <x-slot name="logo">
            {{-- 写真入れてロゴにできる --}}
            
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf



             <label for="file_photo"        class="rounded-circle userProfileImg">
             <div class="userProfileImg_description">画像をアップロード</div>
             <i class="fas fa-camera fa-3x"></i>
             <input type="file" id="file_photo" name="img_name">

             </label>
             <div class="userImgPreview" id="userImgPreview">
             <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
             <p class="userImgPreview_text">画像をアップロード済み</p>
             </div>



            <div class="form-group @error('name')has-error @enderror">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  placeholder="名前を入力してください"/>
                @error('name')
                <span class="errorMessage">
                {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group @error('email')has-error @enderror">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                
                <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="メールアドレスを入力してください"/>
                @error('email')
                 <span class="errorMessage">
                 {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group @error('password')has-error @enderror">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" 
                 placeholder="パスワードを入力してください"/>
            </div>

            <div class="form-group">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" 
                placeholder="パスワードを再度入力してください"/>
            </div>

            <div class="form-group">
                <x-jet-label for="sex" value="{{ __('性別') }}" />
                <div class="form-check form-check-inline">
                    <x-jet-label class="form-check-label" for="inlineRadio1" value="{{ __('男') }}" />
                <x-jet-input id="inlineRadio1" class="form-check-input" type="radio" name="sex" value="0" required checked/>
                
                </div>
                <div class="form-check form-check-inline">
                       <x-jet-label class="form-check-label" for="inlineRadio2" value="{{ __('女') }}" />
                <x-jet-input id="inlineRadio2" class="form-check-input" type="radio" name="sex" value="1" required />
              
                </div>
                 
            </div>

              <div class="form-group @error('self_introduction')has-error @enderror">
                <x-jet-label for="self_introduction" value="{{ __('自己紹介') }}" />
                <textarea class="form-control" name="self_introduction" rows="10" placeholder="自己紹介" required></textarea>
                @error('self_introduction')
                  <span class="errorMessage">
                 {{ $message }}
                 </span>
                 @enderror
            </div>
            

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="text-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
<div class="linkToLogin">
                <x-jet-button class="btn submitBtn texttext text-center" >
                    {{ __('Register') }}
                </x-jet-button>
                 </div>
                  
            </div>
        </form>
    </x-jet-authentication-card>
     </body>
</x-guest-layout>
