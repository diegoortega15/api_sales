<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Repositories\SalespersonRepository;

class SaleRepository {

    public function __construct(Sale $sale){
        $this->model = $sale;
    }

    public function create($sale)
    {
        return $this->model->create($sale);
    }

    public function findById($id){
        return $this->model->with('salespeople')->find($id);
    }
    
    public function getAllSales()
    {
        return $this->model->with('salespeople')->get();
    }
}