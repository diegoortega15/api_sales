<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "commission"
    ];

    //protected $table = 'salespeople';

    public function sales(){
        return $this->hasMany(Sale::class, 'salespeople_id');
    }

    public function rules()
    {
        return [
            'name'=> 'required|min:3',
            'email'=> 'required|unique:salespeople,email,'.$this->id
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email.unique' => 'Email já cadastrado.',
            'name.min'=> 'O nome deve ter no mínimo 3 caracteres'
        ];
    }
}
