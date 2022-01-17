<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        "value",
        "commission_value",
        "salespeople_id"
    ];

    public function salespeople(){
        return $this->belongsTo(Salesperson::class);
    }

    public function rules()
    {
        return [
            'salespeople_id' => 'exists:salespeople,id',
            'value'=> 'required|gt:0',
            'commission_value'=> 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'value.gt' => 'O valor da venda deve ser maior do que 0.',
            'salespeople_id.exists' => 'Vendedor inexistente'
        ];
    }

}
