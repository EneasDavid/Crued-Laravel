<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Models\Alunos;

/**
 * Class AlunosController.
 *
 * @package namespace App\Http\Controllers;
 */
class AlunosController extends Controller
{
    //============================================metodos criados por nos==================================================================================
    public function listarAluno()
    {
        $aluno=Alunos::all();
        if(!empty($aluno)){
            $alunos=Alunos::all();
            return view('index', ['alunos'=>$alunos]);
        }else{
            return view('index', ['alunos'=>null]);
        }
    }
    public function criarAluno()
    {
        return view('criarAluno');
    }
    public function criarAlunoForms(Request $request)
    {
     //Criadno a entidade
        $novoAluno = new Alunos;
        //$novoAlunoTurma = new salaAula;
        $this->validate($request,[
            'nome'=>'required',
            'sala'=>'required',
            'matricula'=>'required',
            'turno'=>'required',
        ],[
            //'required' => ':attribute é um campo obrigartorio!', //Idem do de cima
            'nome.required'=>'O campo Nome é obrigatorio',
            'sala.required'=>'O campo Sala é obrigatorio',
            'turno.required'=>'O campo Turno é obrigatorio',
            'matricula.required'=>'O campo Matrícula é obrigatorio',
            ]);
        //Passando os valores da web/request pro bd
        $novoAluno->nome = $request->nome;
        $novoAluno->sala = $request->sala;
        $novoAluno->turno =$request->turno;
        $novoAluno->matricula=$request->matricula;
        $novoAluno->turno=$request->turno;
            //Upload de imagem
            if($request->hasfile('fotoAluno') && $request->file('fotoAluno')->isValid()){
            //Pega a imagem
                $requestImagem=$request->fotoAluno;
            //pega a extensão
                $extension=$requestImagem->extension();
            //cria o nome da imagem
                $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now").".".$extension);
            //move para a pasta das imagens
                $requestImagem->move(public_path('img/alunos'),$imagemName);
            //salva no bd
                $novoAluno->fotoAluno=$imagemName;
            }
            $novoAluno->save();
            //redirecionando a página
            return redirect('/')->with('msg','Aluno cadastrado com sucesso!');
    }
    public function editarAluno($id)
    {
        $aluno=Alunos::findOrFail($id);
        if(empty($aluno)){
            return redirect('/')->with('msg','Esse aluno não existe!');
        }
           return view('editarAluno',['aluno'=>$aluno]);
    }
    public function editarAlunoForms(request $request)
    {
        $alunoNovo=$request->all();
        //Upload de imagem
        if($request->hasfile('imagem') && $request->file('imagem')->isValid()){
            $requestImagem=$request->imagem;
            //Pega a imagem
            $extension=$requestImagem->extension();
            //pega a extensão
            $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now").".".$extension);
            //cria o nome da imagem
            $request->imagem->move(public_path('img/events'),$imagemName);
            //salva no bd
            $alunoNovo['imagem']=$imagemName;
        }
        Alunos::findOrFail($request->id)->update($alunoNovo);
        $alunoNovo=$request->all();
        return redirect('/')->with('msg','Editado com sucesso!');
        
    }
    public function destruirAluno($id)
    {
        $aluno=Alunos::findOrFail($id);
        if(empty($aluno)){
            return redirect('/')->with('msg','Esse aluno não existe!');
        }
        $aluno->delete();
        return redirect('/')->with('msg','excluido com sucesso!');
    }
//============================================Fim dos metodos criados por nos==================================================================================
}
