<?php

namespace App\Models;

use CodeIgniter\Model;

class MentorModel extends Model
{
    protected $table            = 'mentor';
    protected $primaryKey       = 'mentor_id';

    protected $useTimestamps    = true;
}