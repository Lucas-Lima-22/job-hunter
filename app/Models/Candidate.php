<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'avatar',
            'name',
            'headline',
            'email',
            'phone',
            'street',
            'city',
            'state',
            'summary',
            'experience',
            'skills',
            'education',
    ];

    protected $appends = ['is_active'];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: function () {
                foreach ($this->getAttributes() as $key => $value) {
                    if ($key !== 'avatar' && is_null($value)) {
                        return false;
                    }
                }
                
                return true;
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
