<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;
    protected $fillable = [
        'name', 'nim', 'email', 'password', 'role',
    ];
    
    protected $hidden = ['password'];

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}