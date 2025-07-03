<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function profile()
    {
        $user = $this->user->where('username', session()->get('username'))->first();

        return view('v_profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $user = $this->user->where('username', session()->get('username'))->first();

        $newData = [
            'username' => $this->request->getPost('username'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $filename = $foto->getRandomName();
            $foto->move('uploads/', $filename);
            $newData['foto'] = $filename;
        }

        $this->user->update($user['id'], $newData);
        session()->set('username', $newData['username']);
        session()->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to('profile');
    }
}
