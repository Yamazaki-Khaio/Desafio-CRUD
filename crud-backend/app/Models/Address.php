<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'table_address';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['CEP', 'Logradouro', 'Bairro', 'Cidade', 'UF'];
    use HasFactory;
}
