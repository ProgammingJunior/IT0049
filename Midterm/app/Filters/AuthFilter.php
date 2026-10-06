<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
class AuthFilter implements FilterInterface {
 public function before(RequestInterface $request,$arguments=null) { if (!session()->has('staff_id')) return redirect()->to(site_url('login'))->with('error','Please sign in to continue.'); return null; }
 public function after(RequestInterface $request,ResponseInterface $response,$arguments=null) {}
}