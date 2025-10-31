<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubeMembro extends Model
{
    use HasFactory;
    protected $table = 'clube_membros';
    protected $fillable = ['user_id'];
}
