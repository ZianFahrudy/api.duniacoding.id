<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\EventModel;

class Event extends BaseController
{
    // BELUM BUAT DOKUMENTASI API
    // EVENT MEMBER

    use ResponseTrait;
    protected $EventModel;

    public function __construct()
    {
        $this->EventModel = new EventModel();
    }

    public function index()
    {
        // Get | Read All
        return $this->respond($this->EventModel->orderBy('event_date', 'ASC')->findAll(), 200);
    }

    public function show($id = null)
    {
        // Get | Read Detail
        $data = $this->EventModel->find($id);
        return $data ? $this->respond($data, 200) : $this->failNotFound("Event data with ID $id not found!");
    }

    public function today()
    {
        return $this->respond($this->EventModel->where('event_date', date('Y-m-d'))->orderBy('event_date', 'ASC')->findAll(), 200);
    }

    public function week()
    {
        $where['event_date >= '] = date('D') != 'Mon' ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
        $where['event_date <= '] = date('D') != 'Sun' ? date('Y-m-d', strtotime('next Sunday')) : date('Y-m-d');

        return $this->respond($this->EventModel->where($where)->orderBy('event_date', 'ASC')->findAll(), 200);
    }

    public function date($start = null, $end = null)
    {
        $rules = [
            'start_date'    => ['label' => 'Start Date', 'rules' => 'required|valid_date' ],
            'end_date'      => ['label' => 'End Date',   'rules' => 'required|valid_date' ],
        ];

        if (!$this->validate($rules))
            return $this->fail($this->validation->getErrors());

        $where['event_date >= '] = $this->request->getVar('start_date');
        $where['event_date <= '] = $this->request->getVar('end_date');

        return $this->respond($this->EventModel->where($where)->orderBy('event_date', 'ASC')->findAll(), 200);
    }
}
