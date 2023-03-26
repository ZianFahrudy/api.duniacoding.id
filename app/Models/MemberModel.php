<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class MemberModel extends Model
{
    protected $table            = 'member';
    protected $primaryKey       = 'member_id';
    protected $allowedFields    = [
        'member_name',
        'member_job',
        'member_company',
        'member_email',
        'member_password',
        'member_instagram',
        'member_linkedin',
        'member_avatar'
    ];

    protected $useTimestamps    = true;

    protected $validationRules  = [
        'member_id'         => [ 'label' => 'Member ID', 'rules' => 'required' ],
        'member_name'       => [ 'label' => 'Member Name', 'rules' => 'required' ],
        'member_email'      => [ 'label' => 'Member Email', 'rules' => 'required|is_unique[member.member_email,member_id,{member_id}]' ],
        'member_instagram'  => [ 'label' => 'Member Instagram', 'rules' => 'permit_empty|valid_url' ],
        'member_linkedin'   => [ 'label' => 'Member Linked in', 'rules' => 'permit_empty|valid_url' ],
        'member_avatar'     => [ 'label' => 'Member Avatar', 'rules' => 'max_size[member_avatar,2048]|ext_in[member_avatar,png,jpg,jpeg]mime_in[member_avatar,image/png,image/jpg,image/jpeg]' ],
    ];

    function getEmail($email)
    {
        $builder    = $this->table('member');
        $data       = $builder->where('member_email', $email)->first();

        if (!$data)
            throw new Exception('Authentication data not found!');

        return $data;
    }
}