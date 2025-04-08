<?php

namespace App\Models;

use App\Enums\DisputeResult;
use Illuminate\Database\Eloquent\Model;

class ServiceDispute extends Model
{
    protected $fillable = [
        'schedule_id',
        'complainant_id',
        'complainant_files',
        'defendant_id',
        'defendant_files',  
        'reason',
        'status',
        'resolution',
    ];

    protected $casts = [
        'status' => DisputeResult::class,
    ];

    public function complainant()
    {
        return $this->belongsTo(User::class, 'complainant_id');
    }

    public function defendant()
    {
        return $this->belongsTo(User::class, 'defendant_id');
    }

    public function support()
    {
        return $this->belongsTo(User::class, 'support_agent_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
