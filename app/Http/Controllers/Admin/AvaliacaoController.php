<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AvaliacaoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Avaliacoes;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacoes::orderby('created_at', 'DESC')->paginate(35);
        return view('admin.avaliacoes.index', [
            'avaliacoes' => $avaliacoes,
        ]);
    }

    public function create()
    {
        return view('admin.avaliacoes.create');
    }

    public function store(AvaliacaoRequest $request)
    {
        $avaliacaoCreate = Avaliacoes::create($request->all()); 
        $avaliacaoCreate->save();

        return redirect()->route('avaliacoes.edit', $avaliacaoCreate)->with([
            'color' => 'success', 
            'message' => 'Avaliação cadastrada com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $avaliacao = Avaliacoes::where('id', $id)->first();  
        
        return view('admin.avaliacoes.edit', [
            'avaliacao' => $avaliacao
        ]);
    }

    public function update(AvaliacaoRequest $request, $id)
    {
        $avaliacao = Avaliacoes::where('id', $id)->first();

        $avaliacao->fill($request->all());

        if(!$avaliacao->save()){
            return redirect()->back()->withInput()->withErrors('erro');
        }

        return redirect()->route('avaliacoes.edit', [ 
            'id' => $avaliacao->id
        ])->with([
            'color' => 'success', 
            'message' => 'Avaliação atualizada com sucesso!'
        ]);
    }

    public function avaliacoesSetStatus(Request $request)
    {        
        $avaliacao = Avaliacoes::find($request->id);
        $avaliacao->status = $request->status;
        $avaliacao->save();
        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $avaliacao = Avaliacoes::where('id', $request->id)->first();
        $nome = \App\Helpers\Renato::getPrimeiroNome(Auth::user()->name);
        if(!empty($avaliacao)){
            $json = "<b>$nome</b> você tem certeza que deseja excluir esta Avaliação?";
            return response()->json(['error' => $json,'id' => $avaliacao->id]);
        }else{
            return response()->json(['success' => true]);
        }
    }
    
    public function deleteon(Request $request)
    { 
        $avaliacao = Avaliacoes::where('id', $request->avaliacao_id)->first();  
        $avaliacaoR = $avaliacao->name;
        if(!empty($avaliacao)){            
            $avaliacao->delete();
        }
        return redirect()->route('avaliacoes.index')->with([
            'color' => 'success', 
            'message' => 'A avaliação de '.$avaliacaoR.' foi removida com sucesso!']);
    }
}
