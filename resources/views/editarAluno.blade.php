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
        <form class="container" action="/Forms-Aluno-Editar/{{$aluno->id}}" method="POST" enctype="multipart/form-data">
             @csrf 
             {{--CSRF é um padrão de segurança do Laravel usado em formularios--}}
             <p>Dados pessoais</p>
             <img src="/img/alunos/{{$aluno->fotoAluno}}" style="height: 10rem;" alt="{{$aluno->fotoAluno}}" class="img-preview">
             <input type="file" name="fotoAluno" style="height: 2.5rem; background-color: transparent;" id="fotoAluno" placeholder="Foto:" class="form-control input-home">
             <input type="text" name="nome" placeholder="Nome:" class="input-home" value="{{$aluno->nome}}">
             <input type="text" name="matricula" placeholder="Matricula:" class="input-home" value="{{$aluno->matricula}}">
             <input type="text" name="sala" placeholder="Sala:" class="input-home" value="{{$aluno->sala}}">
             <input type="text" name="turno" placeholder="Turno:" class="input-home" value="{{$aluno->turno}}">
             <button class="btn" type="submit">Salvar</button>
        </from>
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
</body>