<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    public function noticias(): HasMany
    {
        return $this->hasMany(Noticia::class);
    }
}
