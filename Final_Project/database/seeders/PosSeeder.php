<?php
namespace Database\Seeders;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;
class PosSeeder extends Seeder {
    public function run(): void {
        foreach ([['Alice Johnson','alice@example.com','555-0101'],['Bob Smith','bob@example.com','555-0102'],['Carol Davis','carol@example.com','555-0103'],['David Brown','david@example.com','555-0104'],['Eva Wilson','eva@example.com','555-0105']] as [$name,$email,$phone]) {
            Customer::updateOrCreate(['email'=>$email],['full_name'=>$name,'phone'=>$phone]);
        }
        foreach ([['admin','Alex Morgan','admin@example.com'],['jlee','Jamie Lee','jamie.lee@example.com'],['rpatel','Ravi Patel','ravi.patel@example.com']] as [$username,$name,$email]) {
            User::updateOrCreate(['username'=>$username],['full_name'=>$name,'email'=>$email,'password'=>'Daymark123!']);
        }
        foreach ([['House Coffee',85,24],['Iced Matcha Latte',145,20],['Chicken Pesto Sandwich',195,14],['Garden Salad Bowl',165,11],['Chocolate Brownie',75,30],['Garlic Parmesan Fries',110,16]] as [$name,$price,$stock]) {
            Product::updateOrCreate(['name'=>$name],['price'=>$price,'stock_quantity'=>$stock,'is_archived'=>false]);
        }
        if (Sale::exists()) return;
        foreach ([['House Coffee','alice@example.com','admin',2,2],['Iced Matcha Latte','bob@example.com','jlee',1,8],['Chicken Pesto Sandwich',null,'rpatel',1,26]] as [$productName,$email,$username,$quantity,$hours]) {
            $product=Product::where('name',$productName)->firstOrFail();
            $customer=$email?Customer::where('email',$email)->first():null;
            $sale=Sale::create(['product_id'=>$product->id,'customer_id'=>$customer?->id,'sold_by'=>User::where('username',$username)->value('id'),'quantity'=>$quantity,'total_price'=>number_format((int)round((float)$product->price*100)*$quantity/100,2,'.','')]);
            $sale->created_at=now()->subHours($hours); $sale->save(); $product->decrement('stock_quantity',$quantity);
        }
    }
}
