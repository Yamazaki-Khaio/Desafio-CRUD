<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    public function show($id)
    {
        $address = Address::find($id);
        return response()->json($address);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CEP' => 'required',
            'Logradouro' => 'required',
            'Bairro' => 'required',
            'Cidade' => 'required',
            'UF' => 'required',
        ]);

        $address = Address::create($data);
        return response()->json($address, 201);
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $data = $request->validate([
            'CEP' => 'required',
            'Logradouro' => 'required',
            'Bairro' => 'required',
            'Cidade' => 'required',
            'UF' => 'required',
        ]);

        $address->update($data);
        return response()->json($address, 200);
    }

    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $address->delete();
        return response()->json(['message' => 'Endereço removido com sucesso'], 200);
    }

}