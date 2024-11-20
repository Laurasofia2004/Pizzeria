<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // Role agregado si se maneja un sistema de roles
    ];

    /**
     * Los atributos que deben ser ocultados para los arreglos.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos de datos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación con el modelo Client.
     * Un usuario puede tener un cliente asociado (si es de tipo cliente).
     */
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Relación con el modelo Employee.
     * Un usuario puede tener un empleado asociado (si es de tipo empleado).
     */
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
