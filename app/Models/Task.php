<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    // Allow mass assignment on these fields
    protected $fillable = ['user_id', 'title', 'description', 'due_date', 'priority', 'category', 'completed'];

    // Define relationship: Task belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::parse($this->due_date)->format('d-m-Y');
    }
}
