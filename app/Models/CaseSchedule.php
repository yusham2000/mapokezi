<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CaseSchedule extends Model
{
    public const STATUS_WAITING = 'waiting';
    public const STATUS_SERVING = 'serving';
    public const STATUS_DONE = 'done';

    protected $fillable = [
        'case_name',
        'case_number',
        'room',
        'hearing_time',
        'service_date',
        'queue_number',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'service_date' => 'date',
            'hearing_time' => 'datetime:H:i',
        ];
    }

    public static function nextQueueNumberForDate(string $serviceDate): int
    {
        return (int) static::query()
            ->whereDate('service_date', $serviceDate)
            ->max('queue_number') + 1;
    }

    public function markAsServing(): void
    {
        DB::transaction(function (): void {
            // A room can only actively serve one case at a time,
            // but other rooms are still free to serve their own cases.
            static::query()
                ->whereDate('service_date', $this->service_date)
                ->where('room', $this->room)
                ->where('id', '!=', $this->id)
                ->where('status', static::STATUS_SERVING)
                ->update(['status' => static::STATUS_WAITING]);

            $this->update(['status' => static::STATUS_SERVING]);
        });
    }
}
