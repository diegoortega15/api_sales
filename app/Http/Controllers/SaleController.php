<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Repositories\SaleRepository;
use App\Services\SaleService;

class SaleController extends Controller
{
    public function __construct(SaleService $saleService)
    {
       $this->saleService = $saleService;
    }

    public function index()
    {
        return response()->json($this->saleService->getAllSales(), 200);
    }

    public function store(Request $request)
    {
        return $this->saleService->create($request);
    }

    public function show($salespersonId)
    {
        $sale = $this->saleService->findSalesForSalesperson($salespersonId);
        if(empty($sale->toArray())){
            return response()->json(["error" => "Vendedor inexistente"],404);
        }
        return response()->json($sale,200);
    }

    public function destroy($id)
    {
        return $this->saleService->delete($id);
    }
}
