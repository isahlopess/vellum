<div>
    <h1>{{ $livro->id }}</h1>
    <h1>{{ $livro->titulo }}</h1>

    <h2 class="font-bold mt-4">Assuntos:</h2>
    @foreach($livro->assuntos as $assunto)
        <p>{{ $assunto->nome }}</p>
    @endforeach
</div>
