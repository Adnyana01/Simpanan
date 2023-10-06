<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

use App\Models\Neraca;

class NeracaDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $neraca;
    public function __construct()
    {
        $this->neraca = new Neraca();
    }

    public function index()
    {
        try {
            $data = $this->neraca->all();
            return response()->json($data, Response::HTTP_OK);
        } catch (QueryException $e) {
            $errors = ['error' => $e->getMessage()];
            return response()->json($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
