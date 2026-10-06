<?php
namespace App\Controllers;
use App\Models\ProductModel;
use App\Services\ImageUpload;
use RuntimeException;
class ProductController extends BaseController {
 private ProductModel $m; public function __construct(){ $this->m=new ProductModel(); }
 public function index(){return $this->page('pos/table',['title'=>'Products','heading'=>'Products','createUrl'=>site_url('products/new'),'columns'=>[['name'=>'name','label'=>'Product'],['name'=>'price','label'=>'Price'],['name'=>'stock_quantity','label'=>'Stock'],['name'=>'image','label'=>'Image','type'=>'image']],'rows'=>$this->m->where('is_active',1)->orderBy('name')->findAll(),'editBase'=>site_url('products/edit'),'deleteBase'=>site_url('products/archive'),'deleteLabel'=>'Archive']);}
 public function new(){return $this->form([], 'Add product',site_url('products'));}
 public function create(){
  if(!$this->validate(['name'=>'required|max_length[100]','price'=>'required|decimal|greater_than_equal_to[0]','stock_quantity'=>'required|integer|greater_than_equal_to[0]']))return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
  try{$image=ImageUpload::save($this->request->getFile('image'),'products');}catch(RuntimeException $e){return redirect()->back()->withInput()->with('error',$e->getMessage());}
  $this->m->insert(['name'=>trim((string)$this->request->getPost('name')),'price'=>$this->request->getPost('price'),'stock_quantity'=>$this->request->getPost('stock_quantity'),'image'=>$image,'is_active'=>1,'created_at'=>date('Y-m-d H:i:s')]); return redirect()->to(site_url('products'))->with('success','Product added.');
 }
 public function edit(int $id){$r=$this->m->find($id);if(!$r)return redirect()->to(site_url('products'))->with('error','Product not found.');return $this->form($r,'Edit product',site_url('products/update/'.$id));}
 public function update(int $id){
  $r=$this->m->find($id);if(!$r)return redirect()->to(site_url('products'))->with('error','Product not found.');
  if(!$this->validate(['name'=>'required|max_length[100]','price'=>'required|decimal|greater_than_equal_to[0]','stock_quantity'=>'required|integer|greater_than_equal_to[0]']))return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
  try{$image=ImageUpload::save($this->request->getFile('image'),'products');}catch(RuntimeException $e){return redirect()->back()->withInput()->with('error',$e->getMessage());}
  $d=['name'=>trim((string)$this->request->getPost('name')),'price'=>$this->request->getPost('price'),'stock_quantity'=>$this->request->getPost('stock_quantity')];if($image){ImageUpload::delete($r['image']??null);$d['image']=$image;}
  $this->m->update($id,$d);return redirect()->to(site_url('products'))->with('success','Product updated.');
 }
 public function archive(int $id){$this->m->update($id,['is_active'=>0]);return redirect()->to(site_url('products'))->with('success','Product archived.');}
 private function form(array $r,string $h,string $a){return $this->page('pos/form',['title'=>$h,'heading'=>$h,'action'=>$a,'record'=>$r,'backUrl'=>site_url('products'),'fields'=>[['name'=>'name','label'=>'Product name','required'=>true],['name'=>'price','label'=>'Price','type'=>'number','step'=>'0.01','required'=>true],['name'=>'stock_quantity','label'=>'Stock quantity','type'=>'number','required'=>true],['name'=>'image','label'=>'Product image','type'=>'file']]]);}
}