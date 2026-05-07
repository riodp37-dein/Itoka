<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_PIMPINAN = 'pimpinan';
    public const ROLE_KARYAWAN = 'karyawan';

    public const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_PIMPINAN,
        self::ROLE_KARYAWAN,
    ];

    public const ROLE_LABELS = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_PIMPINAN => 'Pimpinan',
        self::ROLE_KARYAWAN => 'Karyawan',
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
        ];
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    public function scopeRole(Builder $query, string $role): Builder
    {
        return $query->where('role', $role);
    }

    public function scopeAdmins(Builder $query): Builder
    {
        return $query->role(self::ROLE_ADMIN);
    }

    public function scopePimpinans(Builder $query): Builder
    {
        return $query->role(self::ROLE_PIMPINAN);
    }

    public function scopeKaryawans(Builder $query): Builder
    {
        return $query->role(self::ROLE_KARYAWAN);
    }

    public static function roleOptions(): array
    {
        return self::ROLES;
    }

    public static function roleLabels(): array
    {
        return self::ROLE_LABELS;
    }

    public function hasRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];

        return in_array($this->role, $roles, true);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isPimpinan(): bool
    {
        return $this->hasRole(self::ROLE_PIMPINAN);
    }

    public function isKaryawan(): bool
    {
        return $this->hasRole(self::ROLE_KARYAWAN);
    }

    public function roleLabel(): string
    {
        return self::ROLE_LABELS[$this->role] ?? ucfirst($this->role);
    }

    public function dashboardRoute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'admin.dashboard',
            self::ROLE_PIMPINAN => 'pimpinan.dashboard',
            default => 'karyawan.dashboard',
        };
    }
}
