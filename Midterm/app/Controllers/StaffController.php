<?php
namespace App\Controllers;
use App\Models\StaffModel;
use App\Services\ImageUpload;
use RuntimeException;
class StaffController extends BaseController {
 private StaffModel $m; public function __construct(){$this->m=new StaffModel();}
 public function index(){return $this->page('pos/table',['title'=>'Staff','heading'=>'Staff','createUrl'=>site_url('staff/new'),'columns'=>[['name'=>'username','label'=>'Username'],['name'=>'full_name','label'=>'Full name'],['name'=>'avatar','label'=>'Avatar','type'=>'image']],'rows'=>$this->m->orderBy('full_name')->findAll(),'editBase'=>site_url('staff/edit'),'deleteBase'=>site_url('staff/delete'),'deleteLabel'=>'Delete']);}
 public function new(){return $this->form([], 'Add staff member',site_url('staff'),false);}
 public function create(){
  if(!$this->validate(['username'=>'required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username]','full_name'=>'required|max_length[100]','password'=>'required|min_length[10]|max_length[255]']))return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
  try{$avatar=ImageUpload::save($this->request->getFile('avatar'),'avatars');}catch(RuntimeException $e){return redirect()->back()->withInput()->with('error',$e->getMessage());}
  $this->m->insert(['username'=>trim((string)$this->request->getPost('username')),'full_name'=>trim((string)$this->request->getPost('full_name')),'password'=>password_hash((string)$this->request->getPost('password'),PASSWORD_DEFAULT),'avatar'=>$avatar,'created_at'=>date('Y-m-d H:i:s')]);return redirect()->to(site_url('staff'))->with('success','Staff member added.');
 }
 public function edit(int $id){$r=$this->m->find($id);if(!$r)return redirect()->to(site_url('staff'))->with('error','Staff member not found.');unset($r['password']);return $this->form($r,'Edit staff member',site_url('staff/update/'.$id),true);}
 public function update(int $id){
  $p=$this->m->find($id);if(!$p)return redirect()->to(site_url('staff'))->with('error','Staff member not found.');
  $rules=['username'=>'required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username,id,'.$id.']','full_name'=>'required|max_length[100]','password'=>'permit_empty|min_length[10]|max_length[255]'];
  if(!$this->validate($rules))return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
  try{$avatar=ImageUpload::save($this->request->getFile('avatar'),'avatars');}catch(RuntimeException $e){return redirect()->back()->withInput()->with('error',$e->getMessage());}
  $d=['username'=>trim((string)$this->request->getPost('username')),'full_name'=>trim((string)$this->request->getPost('full_name'))];$pw=(string)$this->request->getPost('password');if($pw!=='')$d['password']=password_hash($pw,PASSWORD_DEFAULT);if($avatar){ImageUpload::delete($p['avatar']??null);$d['avatar']=$avatar;}
  $this->m->update($id,$d);if((int)session('staff_id')===$id)session()->set(['staff_name'=>$d['full_name'],'staff_avatar'=>$d['avatar']??($p['avatar']??null)]);return redirect()->to(site_url('staff'))->with('success','Staff member updated.');
 }
 public function delete(int $id){if((int)session('staff_id')===$id)return redirect()->to(site_url('staff'))->with('error','You cannot delete your signed-in account.');$r=$this->m->find($id);if(!$r)return redirect()->to(site_url('staff'))->with('error','Staff member not found.');try{$this->m->delete($id);}catch(\Throwable $e){return redirect()->to(site_url('staff'))->with('error','Staff with sales on record cannot be deleted.');}ImageUpload::delete($r['avatar']??null);return redirect()->to(site_url('staff'))->with('success','Staff member deleted.');}
 private function form(array $r,string $h,string $a,bool $edit){return $this->page('pos/form',['title'=>$h,'heading'=>$h,'action'=>$a,'record'=>$r,'backUrl'=>site_url('staff'),'fields'=>[['name'=>'username','label'=>'Username','required'=>true],['name'=>'full_name','label'=>'Full name','required'=>true],['name'=>'password','label'=>$edit?'New password (leave blank to keep current)':'Password','type'=>'password','required'=>!$edit],['name'=>'avatar','label'=>'Avatar image','type'=>'file']]]);}
}