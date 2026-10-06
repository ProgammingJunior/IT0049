<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
abstract class BaseController extends Controller {
 protected $helpers=['form','url']; protected $request;
 public function initController(RequestInterface $request,ResponseInterface $response,LoggerInterface $logger) { parent::initController($request,$response,$logger); }
 protected function page(string $view,array $data=[]) { $data['title']=$data['title']??'QuickSale POS'; return view('pos/layout',['title'=>$data['title'],'content'=>view($view,$data)]); }
}