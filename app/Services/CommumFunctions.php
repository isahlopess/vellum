<?php

namespace App\Services;

use App\Models\Livro;
use App\Models\LivroFavorito;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommumFunctions
{
    public $livroFavorito;
    public $idUsuario;

    public function __construct(){
        $this->idUsuario = auth()->id();
    }

    public function buscarFavorito($livroId){
        try{
            $this->livroFavorito = LivroFavorito::where('livro_id', $livroId)
                ->where('user_id', $this->idUsuario)
                ->firstOrFail();
            return $this->livroFavorito;
        }
        catch(ModelNotFoundException $e){
            return null;
        }
    }

    public function addFavorite($idLivro)
    {
        try {
            $livro = $this->buscarFavorito($idLivro);

            if($livro){
                return [
                    'success' => false,
                    'message' => 'O livro já está nos favoritos'
                ];
            }
            else{
                $novoFavorito = LivroFavorito::create([
                    'livro_id' => $idLivro,
                    'user_id' => $this->idUsuario
                ]);

                return [
                    'success' => true,
                    'data' => $novoFavorito,
                    'message' => 'Livro favorito cadastrado com sucesso!'
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao adicionar favorito: ' . $e->getMessage()
            ];
        }
    }

    public function removeFavorite($idLivro)
    {
        try {
            $livroFavorito = $this->buscarFavorito($idLivro);

            if ($livroFavorito) {
                $livroFavorito->delete();

                return [
                    'success' => true,
                    'message' => 'Livro favorito removido com sucesso!'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Favorito não encontrado!'
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao remover favorito: ' . $e->getMessage()
            ];
        }
    }


    public function isFavorite($livroId)
    {
        return LivroFavorito::where('livro_id', $livroId)
            ->where('user_id', $this->idUsuario)
            ->exists();
    }
}
