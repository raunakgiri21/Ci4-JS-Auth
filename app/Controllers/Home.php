<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if($session->get('id')) {
            $model = new UserModel();
            $result = $model->where('id',$session->get('id'))->first();
            $data['name'] = $result['name'];
            $data['email'] = $result['email'];
            return view('templates/header').view('templates/navbar').view('pages/home',$data).view('templates/footer');
        }
        return redirect()->to(base_url('signin'));
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('signin'));
    }
}
