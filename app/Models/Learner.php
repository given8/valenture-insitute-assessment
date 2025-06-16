<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Learner extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class,'enrolments')->withPivot('progress');
    }

    public function enrolments(): HasMany
    {
        return $this->hasMany(Enrolment::class);
    }

    public function avg():float
   {
        return $this->enrolments()
                    ->avg('progress');
   }
}
