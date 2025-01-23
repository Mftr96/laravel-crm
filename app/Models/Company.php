<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Orchid\Screen\AsSource;

class Company extends Model {
    use AsSource;
    protected $fillable = [
        'name',
        'email',
        'logo',
        'VAT_number',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
