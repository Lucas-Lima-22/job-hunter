<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['candidate_id', 'work_id', 'company_id', 'status'];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('F j, Y g:i A'),
        );
    }

    public function scopeFilter($query, $filter)
    {
        $query->when($filter, fn ($query, $status) => 
            $query->where('status', $status)
        );
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function work()
    {
        return $this->belongsTo(Job::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
