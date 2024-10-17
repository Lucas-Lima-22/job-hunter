<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logo',
        'name',
        'slogan',
        'email',
        'website',
        'street',
        'city',
        'state',
        'about',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            $company->rating = rand(1, 5);
        });
    }

    protected $appends = ['is_active', 'belongs_to_user'];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: function () {
                foreach ($this->attributes as $attribute => $value) {
                    if ($attribute !== 'logo' && empty($value)) {
                        return false;
                    }
                }
                return true;
            }
        );
    }

    protected function belongsToUser(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user_id === auth()->id(),
        );
    }

    protected function website(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? ('https://www.' . $value) : null,
            set: fn (string $value) => str_replace('https://www.', '', $value)
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}