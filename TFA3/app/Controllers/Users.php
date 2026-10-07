<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
class Users extends BaseController
{
    public function index(): string
    {
        return view('users', [
            'title' => 'User Accounts',
            'activePage' => 'users',
            'users' => (new UserModel())->getUsers(),
        ]);
    }
    public function newForm(): string
    {
        return $this->userForm('create');
    }
    public function create(): string|RedirectResponse
    {
        $rules = [
            'username' => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
        ];
        if (! $this->validate($rules)) {
            return $this->userForm('create', $this->request->getPost() ?? [], $this->validator->getErrors());
        }
        (new UserModel())->insert([
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'created_at' => date('Y-m-d H:i:s'),
            'avatar' => null,
        ]);
        session()->setFlashdata('success', 'User account created.');
        return redirect()->to(site_url('users'));
    }
    public function edit(int $id): string
    {
        $user = (new UserModel())->getUser($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User account not found.');
        }
        return $this->userForm('edit', $user, [], $user);
    }
    public function update(int $id): string|RedirectResponse
    {
        $model = new UserModel();
        $user = $model->getUser($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User account not found.');
        }
        $rules = [
            'username' => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];
        $avatar = $this->request->getFile('avatar');
        $hasAvatar = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;
        if ($hasAvatar) {
            $rules['avatar'] = 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]';
            $rules['avatar_thumbnail'] = 'uploaded[avatar_thumbnail]|is_image[avatar_thumbnail]|mime_in[avatar_thumbnail,image/png]|ext_in[avatar_thumbnail,png]|max_size[avatar_thumbnail,1024]|max_dims[avatar_thumbnail,256,256]';
        }
        if (! $this->validate($rules)) {
            return $this->userForm('edit', $this->request->getPost() ?? [], $this->validator->getErrors(), $user);
        }

        $newAvatarName = null;
        if ($hasAvatar) {
            $imageErrors = $this->validateAvatarImages();
            if ($imageErrors !== []) {
                return $this->userForm('edit', $this->request->getPost() ?? [], $imageErrors, $user);
            }
            $thumbnail = $this->request->getFile('avatar_thumbnail');
            $newAvatarName = 'avatar_' . bin2hex(random_bytes(16)) . '.png';
            $avatarDirectory = FCPATH . 'uploads/avatars';
            if (! is_dir($avatarDirectory) && ! mkdir($avatarDirectory, 0755, true) && ! is_dir($avatarDirectory)) {
                return $this->userForm('edit', $this->request->getPost() ?? [], ['avatar' => 'The avatar upload folder is unavailable.'], $user);
            }
            $thumbnail->move($avatarDirectory, $newAvatarName);
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];
        if ($newAvatarName !== null) {
            $data['avatar'] = $newAvatarName;
        }
        if (! $model->update($id, $data)) {
            if ($newAvatarName !== null && is_file(FCPATH . 'uploads/avatars/' . $newAvatarName)) {
                unlink(FCPATH . 'uploads/avatars/' . $newAvatarName);
            }
            return $this->userForm('edit', $this->request->getPost() ?? [], ['form' => 'The user account could not be saved.'], $user);
        }
        if ($newAvatarName !== null && ! empty($user['avatar'])) {
            $this->removeAvatarFile($user['avatar']);
        }
        session()->setFlashdata('success', 'User account updated.');
        return redirect()->to(site_url('users'));
    }
    private function validateAvatarImages(): array
    {
        $avatar = $this->request->getFile('avatar');
        $thumbnail = $this->request->getFile('avatar_thumbnail');
        $originalInfo = @getimagesize($avatar->getTempName());
        if ($avatar->getSize() > 2 * 1024 * 1024 || $originalInfo === false
            || ! in_array($originalInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            return ['avatar' => 'Choose a valid JPG or PNG image no larger than 2 MB.'];
        }
        $thumbnailInfo = @getimagesize($thumbnail->getTempName());
        if ($thumbnailInfo === false || $thumbnailInfo[0] !== 256 || $thumbnailInfo[1] !== 256
            || $thumbnailInfo[2] !== IMAGETYPE_PNG) {
            return ['avatar_thumbnail' => 'The display thumbnail could not be prepared. Please choose the image again.'];
        }
        return [];
    }
    private function removeAvatarFile(string $filename): void
    {
        if (basename($filename) !== $filename) {
            return;
        }
        $path = FCPATH . 'uploads/avatars/' . $filename;
        if (is_file($path)) {
            unlink($path);
        }
    }
    private function userForm(string $mode, array $formData = [], array $errors = [], ?array $user = null): string
    {
        return view('user_form', [
            'title' => $mode === 'create' ? 'New User' : 'Edit User',
            'activePage' => 'users', 'mode' => $mode,
            'formData' => $formData, 'errors' => $errors, 'user' => $user,
        ]);
    }
}