<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;


class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::paginate(4);

        return response()->json($clientes);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cpf' => 'required|string|unique:clientes,cpf',
                'nome' => 'required|string|max:255',
                'data_nascimento' => 'required|date',
                'sexo' => 'required|in:Masculino,Feminino,Outro',
                'endereco' => 'required',
                'estado' => 'required|string|max:2',
                'cidade' => 'required|string|max:255',
            ]);

            $cliente = Cliente::create($request->all());

            return response()->json(['message' => 'Cliente salvo com sucesso', 'dados' => $cliente], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro durante a criação: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        try {
            $request->validate([
                'cpf' => 'required|string|unique:clientes,cpf,' . $cliente->id,
                'nome' => 'required|string|max:255',
                'data_nascimento' => 'required|date',
                'sexo' => 'required|in:Masculino,Feminino,Outro',
                'endereco' => 'required',
                'estado' => 'required|string|max:2',
                'cidade' => 'required|string|max:255',
            ]);

            $cliente->update($request->all());

            return response()->json(['message' => 'Cliente atualizado com sucesso', 'dados' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro durante a atualização: ' . $e->getMessage()], 500);
        }
    }

    public function filtrar(Request $request)
    {
        $query = Cliente::query();

        if ($request->filled('cpf')) {
            $query->where('cpf', $request->input('cpf'));
        }

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->input('nome') . '%');
        }

        if ($request->filled('data_nascimento')) {
            $dataNascimento = \DateTime::createFromFormat('d/m/Y', $request->input('data_nascimento'));
            if ($dataNascimento) {
                $dataNascimentoFormatoBanco = $dataNascimento->format('Y-m-d');
                $query->where('data_nascimento', $dataNascimentoFormatoBanco);
            }
        }

        if ($request->filled('sexo')) {
            $query->where('sexo', $request->input('sexo'));
        }

        if ($request->filled('endereco')) {
            $query->where('endereco', 'like', '%' . $request->input('endereco') . '%');
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        if ($request->filled('cidade')) {
            $query->where('cidade', 'like', '%' . $request->input('cidade') . '%');
        }

        $clientesFiltrados = $query->paginate(4);

        return response()->json($clientesFiltrados);
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return response()->json(['message' => 'excluido com sucesso', 'dados' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro durante a exclusão: ' . $e->getMessage()], 500);
        }
    }
}
