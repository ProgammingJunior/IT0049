<?php
namespace App\Controllers;
use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
class Customers extends BaseController
{
    public function index(): string
    {
        return view('customers', [
            'title' => 'Customer Accounts',
            'activePage' => 'customers',
            'customers' => (new CustomerModel())->getCustomers(),
        ]);
    }
    public function newForm(): string
    {
        return $this->customerForm('create');
    }
    public function create(): string|RedirectResponse
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
        ];
        if (! $this->validate($rules)) {
            return $this->customerForm('create', $this->request->getPost() ?? [], $this->validator->getErrors());
        }
        $phone = trim((string) ($this->request->getPost('phone') ?? ''));
        (new CustomerModel())->insert([
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => $phone === '' ? null : $phone,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        session()->setFlashdata('success', 'Customer account created.');
        return redirect()->to(site_url('customers'));
    }
    public function edit(int $id): string
    {
        $customer = (new CustomerModel())->getCustomer($id);
        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer account not found.');
        }
        return $this->customerForm('edit', $customer, [], $customer);
    }
    public function update(int $id): string|RedirectResponse
    {
        $model = new CustomerModel();
        $customer = $model->getCustomer($id);
        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer account not found.');
        }
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
        ];
        if (! $this->validate($rules)) {
            return $this->customerForm('edit', $this->request->getPost() ?? [], $this->validator->getErrors(), $customer);
        }
        $phone = trim((string) ($this->request->getPost('phone') ?? ''));
        $model->update($id, [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => $phone === '' ? null : $phone,
        ]);
        session()->setFlashdata('success', 'Customer account updated.');
        return redirect()->to(site_url('customers'));
    }
    private function customerForm(string $mode, array $formData = [], array $errors = [], ?array $customer = null): string
    {
        return view('customer_form', [
            'title' => $mode === 'create' ? 'New Customer' : 'Edit Customer',
            'activePage' => 'customers', 'mode' => $mode,
            'formData' => $formData, 'errors' => $errors, 'customer' => $customer,
        ]);
    }
}