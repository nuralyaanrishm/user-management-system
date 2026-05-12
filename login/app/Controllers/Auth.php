<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function registerPost() 
    {
        $model = new UserModel();

        $model->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost()
    {
        $model = new UserModel();

        $user = $model->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set('user', $user);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid login');
    }

    public function dashboard()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('dashboard', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
