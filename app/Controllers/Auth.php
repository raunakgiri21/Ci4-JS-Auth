<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function signin()
    {
      $data['display'] = 'd-none';
      $data['msg'] = [];
      $data['signinActive'] = 'active-tab';
      $data['signupActive'] = '';
      return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signin').view('templates/footer');
    }
    public function signinPost()
    { 
      $model = new UserModel();
      $email = $this->request->getVar('email');
      $password = $this->request->getVar('password');
      $result = $model->where('email',$email)->first();
      if($result) {
        if(!password_verify($password, $result['password'])){
          $data['display'] = '';
          $data['msg'] = ['Incorrect Password!'];
          $data['signinActive'] = 'active-tab';
          $data['signupActive'] = '';
          return $this->response->setJSON($data);
        }else {
          $session = session();
          $session->set('id',$result['id']);
          $data['display'] = 'd-none';
          $data['msg'] = [];
          $data['signinActive'] = 'active-tab';
          $data['signupActive'] = '';
          return $this->response->setJSON($data);
        }
      }else {
        $data['display'] = '';
        $data['msg'] = ['Incorrect Credentials!'];
        $data['signinActive'] = 'active-tab';
        $data['signupActive'] = '';
        return $this->response->setJSON($data);
      }
    }
    public function signup()
    {
      $data['display'] = 'd-none';
      $data['msg'] = [];
      $data['signinActive'] = '';
      $data['signupActive'] = 'active-tab';
      return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signup').view('templates/footer');
    }
    public function signupPost()
    {
      $name = $this->request->getVar('name');
      $email = $this->request->getVar('email');
      $password = $this->request->getVar('password');
      $cnfPassword = $this->request->getVar('cnfpassword');
        if(!$name) {
          $data['display'] = '';
          $data['msg'] = ['Name is required'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return $this->response->setJSON($data);
        }
        if(!$email) {
          $data['display'] = '';
          $data['msg'] = ['Email is required'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return $this->response->setJSON($data);
        }
        if(!$password) {
          $data['display'] = '';
          $data['msg'] = ['Password is required'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return $this->response->setJSON($data);
        }

        $model = new UserModel();
        
        $result = $model->where('email',$email)->first();
        if($result) {
          $data['display'] = '';
          $data['msg'] = ['Email already exists!'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return $this->response->setJSON($data);
        }  
        elseif($password !== $cnfPassword){
          $data['display'] = '';
          $data['msg'] = ['Passwords do not match!'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return $this->response->setJSON($data);
      }else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $model->save([
          'name' => $name,
          'email'  => $email,
          'password'  => $hash,
        ]);
        $session = session();
        $session->set('id',$model->getInsertID());
        $data['display'] = 'd-none';
        $data['msg'] = [];
        $data['signinActive'] = '';
        $data['signupActive'] = 'active-tab';
        return $this->response->setJSON($data);
      }
    }
}