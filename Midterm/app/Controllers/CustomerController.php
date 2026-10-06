<?php
namespace App\Controllers;
use App\Models\CustomerModel;
class CustomerController extends BaseController {
 private CustomerModel $m; public function __construct(){$this->m=new CustomerModel();}
 public function index(){return $this->page('pos/table',['title'=>'Customers','heading'=>'Customers','createUrl'=>site_url('customers/new'),'columns'=>[['name'=>'full_name','label'=>'Name'],['name'=>'email','label'=>'Email'],['name'=>'phone','label'=>'Phone']],'rows'=>$this->m->orderBy('full_name')->findAll(),'editBase'=>site_url('customers/edit'),'deleteBase'=>site_url('customers/delete'),'deleteLabel'=>'Delete']);}
 public function new(){return $this->form([], 'Add customer',site_url('customers'));}
 public function create(){if(!$this->validate(['full_name'=>'required|max_length[100]','email'=>'required|valid_email|max_length[100]','phone'=>'permit_empty|max_length[20]']))return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());$this->m->insert($this->data());return redirect()->to(site_url('customers'))->with('success','Customer added.');}
 public function edit(int $id){$r=$this->m->find($id);if(!$r)return redirect()->to(site_url('customers'))->with('error','Customer not found.');return $this->form($r,'Edit customer',site_url('customers/update/'.$id));}
 public function update(int $id){if(!$this->m->find($id))return redirect()->to(site_url('customers'))->with('error','Customer not found.');if(!$this->validate(['full_name'=>'required|max_length[100]','email'=>'required|valid_email|max_length[100]','phone'=>'permit_empty|max_length[20]']))return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());$d=$this->data();unset($d['created_at']);$this->m->update($id,$d);return redirect()->to(site_url('customers'))->with('success','Customer updated.');}
 public function delete(int $id){$this->m->delete($id);return redirect()->to(site_url('customers'))->with('success','Customer deleted.');}
 private function data(){return ['full_name'=>trim((string)$this->request->getPost('full_name')),'email'=>trim((string)$this->request->getPost('email')),'phone'=>trim((string)$this->request->getPost('phone'))?:null,'created_at'=>date('Y-m-d H:i:s')];}
 private function form(array $r,string $h,string $a){return $this->page('pos/form',['title'=>$h,'heading'=>$h,'action'=>$a,'record'=>$r,'backUrl'=>site_url('customers'),'fields'=>[['name'=>'full_name','label'=>'Full name','required'=>true],['name'=>'email','label'=>'Email','type'=>'email','required'=>true],['name'=>'phone','label'=>'Phone']]]);}
}