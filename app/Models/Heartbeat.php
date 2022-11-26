<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Heartbeat extends Model
{
    use HasUuid, HasFactory, Notifiable;

    const HEARTBEAT_FORMULA_C1 = -0.06366;
    const HEARTBEAT_FORMULA_C2 = 0.12613;
    const HEARTBEAT_FORMULA_C3 = 0.12258;
    const HEARTBEAT_FORMULA_C4 = 0.01593;
    const HEARTBEAT_FORMULA_C5 = 0.03147;
    const HEARTBEAT_DIVIDER_C1 = 500;
    const HEARTBEAT_DIVIDER_C2 = 250;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'time',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    /**
     * Compute the heart rate.
     */
    public function computeHeartRate(bool $save = true): float
    {
        $RADIUS_TIME_C1 = M_PI * ($this->time / Heartbeat::HEARTBEAT_DIVIDER_C1);
        $RADIUS_TIME_C2 = M_PI * ($this->time / Heartbeat::HEARTBEAT_DIVIDER_C2);

        $heart_rate = Heartbeat::HEARTBEAT_FORMULA_C1 +
                      Heartbeat::HEARTBEAT_FORMULA_C2 * cos($RADIUS_TIME_C1) +
                      Heartbeat::HEARTBEAT_FORMULA_C3 * cos($RADIUS_TIME_C2) +
                      Heartbeat::HEARTBEAT_FORMULA_C4 * sin($RADIUS_TIME_C1) +
                      Heartbeat::HEARTBEAT_FORMULA_C5 * sin($RADIUS_TIME_C2);

        //Save the heart rate
        if ($save) 
        {
            $this->heart_rate = $heart_rate;
            $this->save();
        }

        return $heart_rate;
    }
}
