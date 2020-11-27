<?php

namespace App\Services;

use Image;
use App\User;
use App\Models\PixKey;

class UserService
{
    public function create(array $data): User
    {
        $dataUser = $this->generateDataUser($data);
        $dataAddress = $this->generateDataAddress($data);
        $dataBank = $this->generateDataBank($data);

        

        $user = User::create($dataUser);
        $user->address()->create($dataAddress);
        $user->databank()->create($dataBank);
        $this->setPix($user);

        return $user;
    }

    public function update(array $data, User $user): void
    {
        $dataUser = $this->generateDataUser($data);
        $dataAddress = $this->generateDataAddress($data);
        $dataBank = $this->generateDataBank($data);

        $user->update($dataUser);
        $user->address()->update($dataAddress);
        $user->databank()->update($dataBank);
        $this->setPix($user, $data);
    }

    public function generateDataUser(array $data): array
    {
        $dataUser['name'] = $data['name'];
        $dataUser['email'] = $data['email'];
        $dataUser['cpf'] = $data['cpf'];
        $dataUser['rg'] = $data['rg'];
        $dataUser['cellphone'] = $data['cellphone'];
        $dataUser['phone'] = $data['phone'];
        if (isset($data['password'])) {
            $dataUser['password'] = bcrypt($data['password']);
        }
        $dataUser['status'] = 0;

        return $dataUser;
    }
    public function generateDataAddress(array $data): array
    {
        $dataAddress['zip_code'] = $data['zip_code'];
        $dataAddress['street'] = $data['street'];
        $dataAddress['number'] = $data['number'];
        $dataAddress['complement'] = $data['complement'];
        $dataAddress['neighborhood'] = $data['neighborhood'];
        $dataAddress['city'] = $data['city'];
        $dataAddress['state'] = $data['state'];
        return $dataAddress;
    }

    public function generateDataBank(array $data): array
    {
        $dataBank['bank_code'] = $data['bank_code'];
        $dataBank['agency'] = $data['agency'];
        $dataBank['account'] = $data['account'];
        $dataBank['account_type'] = $data['account_type'];
        $dataBank['cpf_holder'] = $data['cpf_holder'];
        $dataBank['name_holder'] = $data['name_holder'];
        $dataBank['type_account'] = $data['type_account'];

        return $dataBank;
    }

    public function avatar($file, $name)
    {
        $originalPath = public_path() . '/uploads/profile/';
        $originalImage = $file;
        $fileName = getNameFile($file, $name);

        $image = Image::make($originalImage);
        $image->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($originalPath . $fileName);

        return $fileName;
    }

    public function setPix(User $user, array $data)
    {
        $pixKey = PixKey::where('user_id', $user->id)->first();
        if($pixKey){
            $pixKey->update([
                'key' => $data['key'],
                'type' => $data['type'],
            ]);
        }else{

            if(isset($data['type'])){
                $user->pixKeys()->create([
                    'key' => $data['key'],
                    'type' => $data['type'],
                ]);
            }
        }
    }
}
