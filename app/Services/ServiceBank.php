<?php

namespace App\Services;

use App\Bank;

class ServiceBank
{
    public function createBank(array $data): array
    {
        try {
            Bank::create($data);
            return ["success" => "Banco Criado Com sucesso"];
        } catch (\Exception $e) {
            return ["error" => "Ops,Tivemos um problema, entre em contato com um de nossos administradores: .{$e->getMessage()}"];
        }
    }

    public function editBank(array $data): array
    {
        $bank = Bank::find($data['bank_code']);
        try {
            $bank->update($data);
            return ["success" => "Banco Editado Com sucesso"];
        } catch (\Exception $e) {
            return ["error" => "Ops,Tivemos um problema, entre em contato com um de nossos administradores: .{$e->getMessage()}"];
        }
    }

    public function deleteBank(Bank $bank): array
    {
        try {
            $bank->delete();
            return ["success" => "Banco Removido Com sucesso"];
        } catch (\Exception $e) {
            return ["error" => "Ops,Tivemos um problema, entre em contato com um de nossos administradores: .{$e->getMessage()}"];
        }
    }
}
