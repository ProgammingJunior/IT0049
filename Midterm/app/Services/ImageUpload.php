<?php
namespace App\Services;
use CodeIgniter\HTTP\Files\UploadedFile;
use RuntimeException;
class ImageUpload {
 public static function save(?UploadedFile $file,string $folder): ?string {
  if ($file===null||$file->getError()===UPLOAD_ERR_NO_FILE) return null;
  if (!$file->isValid()||$file->hasMoved()||$file->getSize()>2097152) throw new RuntimeException('Choose a valid image up to 2 MB.');
  $info=@getimagesize($file->getTempName()); $types=['image/jpeg'=>'jpg','image/png'=>'png','image/gif'=>'gif','image/webp'=>'webp']; $mime=$info['mime']??'';
  if (!$info||!isset($types[$mime])||$info[0]>6000||$info[1]>6000) throw new RuntimeException('Use a JPEG, PNG, GIF, or WebP image no larger than 6000 by 6000 pixels.');
  $dir=FCPATH.'uploads'.DIRECTORY_SEPARATOR.$folder; if (!is_dir($dir)&&!mkdir($dir,0755,true)&&!is_dir($dir)) throw new RuntimeException('Could not create upload folder.');
  $name=bin2hex(random_bytes(16)).'.'.$types[$mime]; $file->move($dir,$name); return $folder.'/'.$name;
 }
 public static function delete(?string $relative): void {
  if (!$relative||basename($relative)!==basename(str_replace('\\','/',$relative))) return;
  $path=FCPATH.'uploads'.DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$relative); if (is_file($path)) @unlink($path);
 }
}