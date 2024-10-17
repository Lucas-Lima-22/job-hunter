<?php

namespace App\Models;

use Carbon\Carbon;

use SebastianBergmann\Type\NullType;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'salary',
        'schedule',
        'model',
        'about',
        'tags',
    ];

    protected $table = 'works';

    protected $casts = [
        'tags' => 'array',
    ];

    protected $appends = ['belongs_to_user'];

    protected function belongsToUser(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company->user_id === auth()->id(),
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('F j, Y g:i A'),
        );
    }

    public function scopeFilter($query, Array $filters) {

        $query->when($filters['cities'] ?? false, fn ($query, $search) => 
            $query->whereHas('company', fn ($query) =>
                $query->whereIn('city', $search)
            )
        );

        $query->when($filters['companies'] ?? false, fn ($query, $search) =>
            $query->whereHas('company', fn ($query) =>
                $query->whereIn('name', $search)
            )
        );

        $query->when($filters['salaries'] ?? false, fn ($query, $search) => 
            $query->where('salary', '>=', $search)
        );

        $query->when($filters['schedules'] ?? false, fn ($query, $search) => 
            $query->whereIn('schedule', $search)
        );

        $query->when($filters['models'] ?? false, fn ($query, $search) => 
            $query->whereIn('model', $search)
        );

        $query->when($filters['tags'] ?? false, function ($query, $search) {
            foreach ($search as $tag) {
                $query->where('tags', 'like', '%' . $tag . '%');
            }
        });

        $query->when($filters['title'] ?? false, function ($query, $search) {
            $query->whereIn('title', $search);
        });
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'work_id');
    }
}
