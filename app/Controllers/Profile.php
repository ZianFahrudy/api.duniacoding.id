<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\MemberModel;

class Profile extends BaseController
{
    use ResponseTrait;
    protected $MemberModel;

    public function __construct()
    {
        $this->MemberModel = new MemberModel();
    }

    public function show()
    {
        // Get | Read Detail
        $id = $this->request->getVar('member_id');

        if (!$id)
            return $this->failNotFound("ID not found!");

        $data = $this->MemberModel->find($id);
        return $data ? $this->respond($data, 200) : $this->failNotFound("Profile data not found!");
    }

    public function update()
    {
        // Post | Update
        $id     = $this->request->getVar('member_id');
        $data   = $this->request->getPost();
        $media  = $this->request->getFile('member_avatar');

        if (!$id)
            return $this->failNotFound("ID not found!");

        $detail = $this->MemberModel->find($id);

        if (!$detail)
            return $this->failNotFound("Profile data not found!");

        $data['member_avatar'] = $media->getError() != 4 ? $media->getRandomName() : '';

        if (isset($data['member_password']))
            unset($data['member_password']);

        if (!$this->MemberModel->save($data))
            return $this->fail($this->MemberModel->errors());

        if ($media->getError() != 4) {
            if ($detail['member_avatar'] != '' && file_exists('assets/img/member/'.$detail['member_avatar']))
                unlink('assets/img/member/'.$detail['member_avatar']);

            $media->move('assets/img/member', $data['member_avatar']);
        }

        $response = ['status' => 201, 'error' => null, 'message' => ['success' => "Profile data successfully changed!"]];
        return $this->respond($response);
    }

    public function password()
    {
        // Post | Password
        $rules = [
            'member_id'             => ['label' => 'ID', 'rules' => 'required' ],
            'member_password_old'   => ['label' => 'Old Password', 'rules' => 'required|min_length[8]' ],
            'member_password_new'   => ['label' => 'New Password', 'rules' => 'required|min_length[8]' ],
            'member_password_conf'  => ['label' => 'Confirmation Password', 'rules' => 'required|min_length[8]|matches[member_password_new]' ]
        ];

        if (!$this->validate($rules))
            return $this->fail($this->validation->getErrors());

        $id     = $this->request->getVar('member_id');
        $data   = $this->request->getPost();
        $detail = $this->MemberModel->find($id);

        if (!$detail)
            return $this->failNotFound("Profile data not found!");

        if (sha1($this->request->getVar('member_password_old')) !== $detail['member_password'])
            return $this->fail(['member_password_old' => 'Old Password Invalid!']);

        $save['member_id']          = $data['member_id'];
        $save['member_password']    = sha1($data['member_password_new']);

        if (!$this->MemberModel->save($save))
            return $this->fail($this->MemberModel->errors());

        $response = ['status' => 201, 'error' => null, 'message' => ['success' => "Profile password data successfully changed!"]];
        return $this->respond($response);
    }
}
