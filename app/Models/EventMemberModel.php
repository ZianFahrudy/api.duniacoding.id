<?php

namespace App\Models;

use CodeIgniter\Model;

class EventMemberModel extends Model
{
    protected $table            = 'event_member';
    protected $primaryKey       = 'event_member_id';
    protected $allowedFields    = [ 'event_id', 'member_id', 'member_event_date', 'member_event_attendance' ];

    protected $useTimestamps    = true;
}