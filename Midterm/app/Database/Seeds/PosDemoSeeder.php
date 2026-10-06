<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class PosDemoSeeder extends Seeder {
 public function run(){$items=[['Classic Burger',8.50],['Chicken Sandwich',7.25],['French Fries',3.50],['Garden Salad',6.00],['Iced Coffee',3.25],['Lemonade',2.75],['Chocolate Cake',4.50],['Bottled Water',1.50]];foreach($items as [$name,$price])if(!$this->db->table('products')->where('name',$name)->countAllResults())$this->db->table('products')->insert(['name'=>$name,'price'=>$price,'stock_quantity'=>20,'is_active'=>1,'created_at'=>date('Y-m-d H:i:s')]);}
}