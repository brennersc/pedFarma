<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $fornecedor = Fornecedor::all();
            return $fornecedor;
        } catch (\Exception $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];
            return response()->json($json, 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               //
        $validator = Validator::make($request->all(), [
            'cnpj' => 'required|cnpj',
        ]);

        if ($validator->fails()) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => 'CNPJ inválido.',
                ],
            ];
            return response()->json($json, 400);
        }

        if (Fornecedor::where('cnpj', $request->cnpj)->first() != null) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => 'Este CNPJ já esta cadastrado.',
                ],
            ];
            return response()->json($json, 400);
        } else if (Fornecedor::where('email', $request->email)->first() != null) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => 'Este Email já esta cadastrado.',
                ],
            ];
            return response()->json($json, 400);
        } else {
            try {
                return Fornecedor::create($request->all());
            } catch (\Exception $e) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage(),
                    ],
                ];

                return response()->json($json, 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Fornecedor::find($id);
        } catch (\Exception $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $fornecedor = Fornecedor::findOrFail($id);
            $fornecedor->update($request->all());

            return $fornecedor;

        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $fornecedor = Fornecedor::findOrFail($id);
            $fornecedor->delete();

            return 204;

        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }
}
