<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'logo', 'VAT_number'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
