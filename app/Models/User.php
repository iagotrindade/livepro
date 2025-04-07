<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatus;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cpf_cnpj',
        'birthdate',    
        'biography',
        'phone',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class
        ];
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function accessTokens(): HasMany
    {
        return $this->hasMany(AccessToken::class);
    }

    public function clientPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'client_id');
    }

    public function professionalPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'professional_id');
    }

    public function professionalOccupations(): HasMany
    {
        return $this->hasMany(ProfessionalOccupation::class, 'user_id', 'id');
    }

    public function occupations(): HasManyThrough
    {
        return $this->hasManyThrough(Occupation::class, ProfessionalOccupation::class, 'professional_id', 'id', 'id', 'occupation_id');
    }
 
    protected $appends = ['rating'];

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'entity');
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id', 'id');
    }

    public function lastActivity()
    {
        $lastSession = $this->sessions()
            ->orderBy('last_activity', 'desc')
            ->first();

        return $lastSession ? \Carbon\Carbon::createFromTimestamp($lastSession->last_activity, 'America/Sao_Paulo') : null;
    }

    public function notificationPreferences(): HasOne
    {
        return $this->hasOne(NotificationPreference::class);
    }
}
