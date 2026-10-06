<?php
namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\ProductModel;
class SaleController extends BaseController {
 public function new(){return $this->page('sales/new',['title'=>'Record sale','products'=>(new ProductModel())->where('is_active',1)->where('stock_quantity >',0)->orderBy('name')->findAll(),'customers'=>(new CustomerModel())->orderBy('full_name')->findAll()]);}
 public function create(){
  if(!$this->validate(['product_id'=>'required|is_natural_no_zero','quantity'=>'required|is_natural_no_zero','customer_id'=>'permit_empty|is_natural']))return redirect()->back()->withInput()->with('error','Select a product and enter a quantity greater than zero.');
  $db=db_connect();$db->transBegin();$p=$db->query('SELECT * FROM products WHERE id=? AND is_active=1 FOR UPDATE',[(int)$this->request->getPost('product_id')])->getRowArray();$q=(int)$this->request->getPost('quantity');
  if(!$p||$q>(int)$p['stock_quantity']){$db->transRollback();return redirect()->back()->withInput()->with('error',$p?'Requested quantity exceeds available stock ('.(int)$p['stock_quantity'].').':'That product is unavailable.');}
  $cid=(int)$this->request->getPost('customer_id')?:null;if($cid&&!(new CustomerModel())->find($cid)){$db->transRollback();return redirect()->back()->withInput()->with('error','Choose a valid customer or leave customer blank.');}
  $total=round((float)$p['price']*$q,2);$db->table('sales')->insert(['product_id'=>(int)$p['id'],'customer_id'=>$cid,'sold_by'=>(int)session('staff_id'),'quantity'=>$q,'total_price'=>number_format($total,2,'.',''),'created_at'=>date('Y-m-d H:i:s')]);$db->table('products')->where('id',(int)$p['id'])->update(['stock_quantity'=>(int)$p['stock_quantity']-$q]);
  if(!$db->transStatus()){$db->transRollback();return redirect()->back()->withInput()->with('error','The sale could not be saved. Please try again.');}$db->transCommit();return redirect()->to(site_url('sales/history'))->with('success','Sale recorded. Total: $'.number_format($total,2));
 }
 public function index(){$rows=db_connect()->query('SELECT s.id,p.name AS product_name,c.full_name AS customer_name,u.full_name AS staff_name,s.quantity,s.total_price,s.created_at FROM sales s JOIN products p ON p.id=s.product_id LEFT JOIN customers c ON c.id=s.customer_id JOIN users u ON u.id=s.sold_by ORDER BY s.created_at DESC,s.id DESC')->getResultArray();return $this->page('pos/table',['title'=>'Sales history','heading'=>'Sales history','columns'=>[['name'=>'product_name','label'=>'Product'],['name'=>'customer_name','label'=>'Customer'],['name'=>'staff_name','label'=>'Staff'],['name'=>'quantity','label'=>'Qty'],['name'=>'total_price','label'=>'Total'],['name'=>'created_at','label'=>'Date']],'rows'=>$rows]);}
}