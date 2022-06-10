<?php

namespace App\Models;

use App\Jobs\EventCreateEmailJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name', 'event_description', 'event_timestamp', 'is_approved', 'created_by', 'updated_by',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected $casts = [
        'event_timestamp' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (Event $modelObj) {
            $modelObj->created_by = auth()->id();
            $modelObj->updated_by = auth()->id();
            if (auth()->user()->role == 'user') dispatch(new EventCreateEmailJob(auth()->user()->name));
        });
        self::updating(function (Event $modelObj) {
            $modelObj->updated_by = auth()->id();
        });
    }
}
