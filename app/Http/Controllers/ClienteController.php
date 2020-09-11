<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cliente = Cliente::all();
            return $cliente;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|cpf',
        ]);

        if ($validator->fails()) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => 'CPF inválido.',
                ],
            ];
            return response()->json($json, 400);
        }

        if (Cliente::where('cpf', $request->cpf)->first() != null) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => 'Este CPF já esta cadastrado.',
                ],
            ];
            return response()->json($json, 400);
            
        } else if (Cliente::where('email', $request->email)->first() != null) {
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
                return Cliente::create($request->all());
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Cliente::find($id);
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());

            return $cliente;

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

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
