<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;





class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
       'self_introduction' => ['string', 'max:255'],
           
           'img_name' => ['file','image', 'mimes:jpeg,png,jpg,gif,x-icon', 'max:2000'],


        ])->validate();

        
        $imageFile = $input->file('img_name');
        $filenameWithExt = $imageFile->getClientOriginalName();

        $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $imageFile->getClientOriginalExtension();
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        $fileData = file_get_contents($imageFile->getRealPath());
        if ($extension = 'jpg'){
        $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
        }

        if ($extension = 'jpeg'){
        $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
        }

        if ($extension = 'png'){
        $data_url = 'data:image/png;base64,'. base64_encode($fileData);
        }

        if ($extension = 'gif'){
        $data_url = 'data:image/gif;base64,'. base64_encode($fileData);
        }
        if ($extension = 'x-icon'){
        $data_url = 'data:image/x-icon;base64,'. base64_encode($fileData);
        }
        $image = Image::make($data_url);
        $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'self_introduction' => $input['self_introduction'],
            'sex' => $input['sex'],
            'img_name' => $fileNameToStore,
        ]);
    }
}
