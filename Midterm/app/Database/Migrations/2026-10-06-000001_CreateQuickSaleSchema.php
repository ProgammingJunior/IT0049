<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateQuickSaleSchema extends Migration {
 public function up(){
  $db=db_connect();$f=$this->forge;
  if(!$db->tableExists('products')){$f->addField(['id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],'name'=>['type'=>'VARCHAR','constraint'=>100],'price'=>['type'=>'DECIMAL','constraint'=>'10,2'],'stock_quantity'=>['type'=>'INT','unsigned'=>true,'default'=>0],'image'=>['type'=>'VARCHAR','constraint'=>255,'null'=>true],'is_active'=>['type'=>'TINYINT','constraint'=>1,'default'=>1],'created_at'=>['type'=>'DATETIME']]);$f->addKey('id',true);$f->createTable('products');}
  if(!$db->tableExists('customers')){$f->addField(['id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],'full_name'=>['type'=>'VARCHAR','constraint'=>100],'email'=>['type'=>'VARCHAR','constraint'=>100],'phone'=>['type'=>'VARCHAR','constraint'=>20,'null'=>true],'created_at'=>['type'=>'DATETIME']]);$f->addKey('id',true);$f->createTable('customers');}
  if(!$db->tableExists('users')){$f->addField(['id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],'username'=>['type'=>'VARCHAR','constraint'=>50],'full_name'=>['type'=>'VARCHAR','constraint'=>100],'password'=>['type'=>'VARCHAR','constraint'=>255],'avatar'=>['type'=>'VARCHAR','constraint'=>255,'null'=>true],'created_at'=>['type'=>'DATETIME']]);$f->addKey('id',true);$f->addUniqueKey('username');$f->createTable('users');}
  if(!$db->tableExists('sales')){$f->addField(['id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],'product_id'=>['type'=>'INT','unsigned'=>true],'customer_id'=>['type'=>'INT','unsigned'=>true,'null'=>true],'sold_by'=>['type'=>'INT','unsigned'=>true],'quantity'=>['type'=>'INT','unsigned'=>true],'total_price'=>['type'=>'DECIMAL','constraint'=>'10,2'],'created_at'=>['type'=>'DATETIME']]);$f->addKey('id',true);$f->addForeignKey('product_id','products','id','CASCADE','RESTRICT');$f->addForeignKey('customer_id','customers','id','CASCADE','SET NULL');$f->addForeignKey('sold_by','users','id','CASCADE','RESTRICT');$f->createTable('sales');}
  if($db->tableExists('users')&&!$db->table('users')->where('username','admin')->countAllResults())$db->table('users')->insert(['username'=>'admin','full_name'=>'QuickSale Administrator','password'=>password_hash('ChangeMe123!',PASSWORD_DEFAULT),'created_at'=>date('Y-m-d H:i:s')]);
 }
 public function down(){ /* Preserve transaction data on rollback. */ }
}