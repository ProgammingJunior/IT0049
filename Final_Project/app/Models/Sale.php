<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Sale extends Model {
    use HasFactory;
    protected $fillable = ['product_id', 'customer_id', 'sold_by', 'quantity', 'total_price'];
    protected function casts(): array { return ['quantity' => 'integer', 'total_price' => 'decimal:2']; }
    public function product(): BelongsTo { return $this->belongsTo(Product::class); }
    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
    public function staff(): BelongsTo { return $this->belongsTo(User::class, 'sold_by'); }
}
