<?php

namespace App\Http\Controllers;

//use App\Models\Salesperson;
use App\Repositories\SalespersonRepository;
use Illuminate\Http\Request;

class SalespersonController extends Controller
{

    public function __construct(SalespersonRepository $salespersonRepository)
    {
       $this->salespersonRepository = $salespersonRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->salespersonRepository->getAll(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->salespersonRepository->create($request),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesperson = $this->salespersonRepository->getById($id);
        if(empty($salesperson->toArray())){
            return response()->json(["error" => "Vendedor não existe"],404);
        }
        return response()->json($salesperson,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $salesperson = $this->salesperson->find($id);
    //     if($salesperson===null){
    //         return response()->json(["error" => "Não foi possível atualizar os dados, vendedor não existe."],404);
    //     }
        
    //     foreach($salesperson->rules() as $input =>$rule){
    //         if(array_key_exists($input, $request->all())){
    //             $dinamicRules[$input]=$rule;
    //         }
    //     }
    //     $request->validate($dinamicRules, $this->salesperson->feedback());
        
    //     $salesperson->update($request->all());
    //     return response()->json($salesperson,200);
    
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->salespersonRepository->delete($id);
    }
}
