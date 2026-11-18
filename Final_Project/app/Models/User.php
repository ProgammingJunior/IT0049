<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected $fillable = ['username', 'full_name', 'name', 'email', 'password', 'avatar'];
    protected $hidden = ['password', 'remember_token'];
    protected function casts(): array { return ['email_verified_at' => 'datetime', 'password' => 'hashed']; }
    public function getNameAttribute(): string { return $this->full_name; }
    public function setNameAttribute(string $value): void { $this->attributes['full_name'] = $value; }
    public function sales(): HasMany { return $this->hasMany(Sale::class, 'sold_by'); }
}
