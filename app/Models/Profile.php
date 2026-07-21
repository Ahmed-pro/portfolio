<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'avatar',
        'resume',
        'email',
        'phone',
        'location',
        'years_experience',
        'socials',
        'highlights',
    ];

    protected $casts = [
        'socials' => 'array',
        'highlights' => 'array',
        'years_experience' => 'integer',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'name' => 'Your Name',
            'title' => 'Web Developer',
        ]);
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar ? Storage::disk('public')->url($this->avatar) : null;
    }

    public function getResumeUrlAttribute(): ?string
    {
        return $this->resume ? Storage::disk('public')->url($this->resume) : null;
    }
}
