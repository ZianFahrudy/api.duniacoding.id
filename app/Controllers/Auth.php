<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\MemberModel;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $MemberModel;

    public function __construct()
    {
        $this->MemberModel = new MemberModel();
    }

    public function index()
    {
        $rules = [
            'email'     => [ 'label' => 'Email', 'rules' => 'required'],
            'password'  => [ 'label' => 'Password', 'rules' => 'required|min_length[8]']
        ];

        if (!$this->validate($rules))
            return $this->fail($this->validation->getErrors());

        $data = $this->MemberModel->where('member_email', $this->request->getVar('email'))->first();

        if (!$data)
            return $this->fail('Email not found!');

        if ($data['member_password'] != sha1($this->request->getVar('password')))
            return $this->fail('Invalid Password!');

        $response = [ 'message' => 'Authentication is successful!', 'token' => createJWT($this->request->getVar('email')) ];

        return $this->respond($response);
    }
    
    public function check()
    {
        $inputan    = $this->request->getVar('token');
        $response   = ($inputan) ? [ 'message' => validateJWT($inputan) ] : [ 'message' => false ];
        
        return $this->respond($response);
    }

    public function register()
    {
        $rules = [
            'member_name'           => [ 'label' => 'Fullname', 'rules' => 'required' ],
            'member_email'          => [ 'label' => 'Email', 'rules' => 'required|is_unique[member.member_email]' ],
            'member_password'       => [ 'label' => 'Password', 'rules' => 'required|min_length[8]' ],
            'member_conf_password'  => [ 'label' => 'Password Confirmation', 'rules' => 'required|min_length[8]|matches[member_password]' ]
        ];

        if (!$this->validate($rules))
            return $this->fail($this->validation->getErrors());

        $data                       = $this->request->getPost();
        $data['member_password']    = sha1($data['member_password']);

        unset($data['member_conf_password']);

        if (!$this->MemberModel->save($data))
            return $this->fail($this->MemberModel->errors());

        $response = ['status' => 201, 'error' => null, 'message' => ['success' => "Member data successfully registered!"]];
        return $this->respond($response);
    }

    public function logout()
    {
        $this->session->destroy();
        
        $response = [ 'message' => 'Re-authenticate to get token!' ];
        return $this->respond($response);
    }
}
