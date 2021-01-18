<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Intervention\Image\Facades\Image;
use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices; 



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
           
           'img_name' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000'],


        ])->validate();

        //引数 $data から name='img_name'を取得(アップロードするファイル情報)
        $imageFile = $input['img_name'];

        $list = FileUploadServices::fileUpload($imageFile);
         list($extension, $fileNameToStore, $fileData) = $list;
        $data_url = CheckExtensionServices::checkExtension($fileData, $extension); 

        //画像アップロード(Imageクラス makeメソッドを使用)
        $image = Image::make($data_url);

        //画像を横400px, 縦400pxにリサイズし保存
        $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );
        // ---ここまで追加---

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
