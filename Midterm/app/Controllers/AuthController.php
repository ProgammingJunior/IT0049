<?php
namespace App\Controllers;
use App\Models\StaffModel;
class AuthController extends BaseController {
 public function login() { if(session()->has('staff_id')) return redirect()->to(site_url('pos')); return $this->page('auth/login',['title'=>'Sign in']); }
 public function attempt() {
  if(!$this->validate(['username'=>'required|max_length[50]','password'=>'required'])) return redirect()->back()->withInput()->with('error','Enter your username and password.');
  $u=(new StaffModel())->where('username',trim((string)$this->request->getPost('username')))->first();
  if(!$u||!password_verify((string)$this->request->getPost('password'),$u['password'])) return redirect()->back()->withInput()->with('error','The username or password is incorrect.');
  session()->regenerate(); session()->set(['staff_id'=>(int)$u['id'],'staff_name'=>$u['full_name'],'staff_avatar'=>$u['avatar']??null]); return redirect()->to(site_url('pos'));
 }
 public function logout() { session()->destroy(); return redirect()->to(site_url('login')); }
}