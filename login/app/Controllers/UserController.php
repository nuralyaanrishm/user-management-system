<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();

        return view('dashboard', $data);
    }

    public function create()
    {
        return view('create_user');
    }

    public function store()
    {
        $model = new UserModel();

        $model->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();

        $data['user'] = $model->find($id);

        return view('edit_user', $data);
    }

    public function update($id)
    {
        $model = new UserModel();

        $model->update($id, [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ]);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        if ($id == session('user.id')) {
            return redirect()->back()->with('error', 'Cannot delete your own account');
        }

        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/users');
    }
}