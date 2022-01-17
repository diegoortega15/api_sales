<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use App\Repositories\SalespersonRepository;
use Illuminate\Http\Request;

class SaleService
{
    public function __construct(SaleRepository $saleRepository, SalespersonRepository $salespersonRepository)
    {
        $this->saleRepository = $saleRepository;
        $this->salespersonRepository = $salespersonRepository;
    }

    public function create(Request $request)
    {
        $return = $this->validation($request);
        if(array_key_exists('error',$return)){
            return response()->json($return,404);
        }

        $commissionValue = $this->caulateComission($return['value'],$return['commission']);
        $saleCreated = $this->saleRepository->create($this->make($return, $commissionValue));
        $sale = $this->saleRepository->findById($saleCreated->id);
        
        return response()->json($this->makeReturn($sale),201);
    }

    public function makeReturn($sale){
        //dd($sale);
        return [
            "sale_id"=>$sale->id,
            "salesperson_name"=>$sale->salespeople->name,
            "salesperson_email"=>$sale->salespeople->email,
            "commission_value"=>$sale->commission_value,
            "sale_value"=>$sale->value,
            "sale_date"=>$sale->created_at
        ];
    }

    public function make($data, $comissionValue)
    {
        return [
            "salespeople_id" => $data['salespersonId'],
            "value" => $data['value'],
            "commission_value" => $comissionValue
        ];
    }

    public function caulateComission($value, $comission)
    {
        return $value * ($comission/100);
    }

    public function validation(Request $request)
    {
        $salespeopleId = $request->salespeople_id ?? 0;
        $value = $request->value ?? 0;
        if(!$salespeopleId){
            return ["error"=>"Campo salespeople_id inválido."];
        }
        if($value <= 0){
            return ["error"=>"Campo value deve ser maior do que 0."];
        }

        $salespersonComission = $this->salespersonRepository->getComission($salespeopleId);
        if($salespersonComission==0){
            return ["error" => "Campo salespeople_id não existe"];
        }
        return [
            'salespersonId'=>$salespeopleId,
            'value' => $value,
            'commission'=> $salespersonComission
        ];

    }

    public function getAllSales()
    {
        return $this->saleRepository->getAllSales();
    }

    public function findSalesForSalesperson($salespersonId)
    {        
        return $this->salespersonRepository->findSalesForSalesperson($salespersonId);
    }

    public function delete($id)
    {
        $sale = $this->saleRepository->findById($id);
        if($sale===null){
            return response()->json(["error" => "Não foi possível excluir, venda não existe."],404);
        }
        $sale->delete();
        return response()->json(["msg"=>"Venda nº ". $sale->id ." removida com sucesso."],200);
    }
}