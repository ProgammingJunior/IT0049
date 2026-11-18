<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model {
    use HasFactory;
    protected $fillable = ['name', 'price', 'stock_quantity', 'image', 'is_archived'];
    protected function casts(): array { return ['price' => 'decimal:2', 'stock_quantity' => 'integer', 'is_archived' => 'boolean']; }
    public function sales(): HasMany { return $this->hasMany(Sale::class); }
}
