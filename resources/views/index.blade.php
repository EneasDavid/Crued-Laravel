<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema Acadêmico</title>
    </head>
<body>
    {{--Comentario em Laravel (Não aparece na web, apenas no ambiente de desenvolvimento)
            Esse if é destinado a verificar se existe algum erro, e caso exista, mostrar a mensagem no front
            --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        <div style="display: flex;align-items: center;flex-wrap: wrap;"> 
        @if(count($alunos)==0)
             <p><b>Nenhum aluno cadastrado </b><a href="/criarAluno">criar aluno</a></p>    
        @else
        @foreach($alunos as $entidade)
         <div class="container marketing pt-5" style="width: auto;">   
             <div class="row featurette">
               <div style="color: #000;" class="col-md-3">
                 <div class="p-2 d-flex flex-column  align-items-center  border border-secondary rounded" style="width: fit-content;">
                         @if(!empty($entidade->fotoAluno))
                              <p class="img"><img src="/img/alunos/{{$entidade->fotoAluno}}" class="selecionar-foto" style="padding:0 !important;height: 10rem;" alt="selecionar foto"></p>
                         @endif
                              <p><b>Nome: </b>{{$entidade->nome}}</p>     
                              <p><b>Matricula: </b>{{$entidade->matricula}}</p>    
                         </div>
                         <div class="pesquisa">
                             <p><b>Turma: </b>{{$entidade->sala}} {{$entidade->turno}} </p>
                             <a href="editarAluno/{{$entidade->id}}" class="btn" style="height: auto">Editar Aluno</a>    
                             <form action="/destruir/{{$entidade->id}}" method="POST">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                             </form>
                             </div>
                         </div>
                       </div>
                      </div>
                     </div>
                     @endforeach
                 @endif
                <a href="/criarAluno">criar aluno</a>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
</body>
