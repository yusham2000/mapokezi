<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'message',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function scopeActiveForDate(Builder $query, Carbon $date): Builder
    {
        return $query
            ->where('is_active', true)
            ->where(function (Builder $query) use ($date): void {
                $query->whereNull('start_date')
                    ->orWhereDate('start_date', '<=', $date);
            })
            ->where(function (Builder $query) use ($date): void {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $date);
            });
    }
}
