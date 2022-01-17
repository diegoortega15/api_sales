<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Salesperson;

class SalespersonRepository {

    public function __construct(Salesperson $salesperson){
        $this->model = $salesperson;
    }

    public function getAll()
    {
        return $this->model->select('id', 'name', 'email', 'commission')->get();
    }

    public function getById($id)
    {
        $salesperson = $this->model->select('id', 'name', 'email')->where('id', $id)->get();
        return $salesperson ?? 0;
    }

    public function getComission($id)
    {
        $salespersonCommission =$this->model->select('commission')->where('id', $id)->get()->toArray();
        if(empty($salespersonCommission)){
            return 0;
        }
        return $salespersonCommission[0]['commission'];
    }

    public function create(Request $request)
    {
        $request->validate($this->model->rules(), $this->model->feedback());
        $salesperson = $this->model->create($request->all());
        return $this->getById($salesperson->id);
    }

    public function delete($id)
    {
        $salesperson =  $this->model->find($id);
        if($salesperson===null){
            return response()->json(["error" => "Não foi possível excluir, vendedor não existe."],404);
        }
        $salesperson->delete();
        return response()->json(["msg"=>"Vendedor ". $salesperson->id ." removido com sucesso."],200);
    }

    public function findSalesForSalesperson($salespersonId)
    {
        $query = $this->model
                    ->select('id', 'name', 'email','commission')
                    ->with([
                        'sales'=> function ($q) {
                            $q->selectRaw(
                                'value as sale_value, commission_value, created_at as sale_date, salespeople_id'
                            )
                            ->get();
                        }])
                    ->where('id', $salespersonId);
        return $query->get();
    }

}