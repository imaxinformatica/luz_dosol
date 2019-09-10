<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{



    public function update(Request $request, Conteudo $conteudos)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'content' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return redirect()->back()->with('success', 'Esse usuário não existe');
        }

        $data = [
            'user_id'           => $user->id,
            'name'              => $request->name,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'content'           => $request->content,
        ];
        $conteudos->update($data);

        return redirect(route('admin.conteudo.index'))->with('Sucesso ', 'Pilar de conteudo alterado com sucesso');
    }
}
