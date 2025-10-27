<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\core\Request;
use app\models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display all suppliers
     */
    public function index()
    {
        $suppliers = Supplier::all();

        $data = [
            'title' => 'Supplier Masterlist',
            'suppliers' => $suppliers
        ];

        return $this->view('admin/supplier/index', $data);
    }

    /**
     * Show create supplier form
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Supplier'
        ];

        return $this->view('admin/supplier/create', $data);
    }

    /**
     * Store new supplier
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_name' => 'required',
            'contact_person' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'status' => 'required'
        ]);

        // Check if supplier name already exists
        $existing = Supplier::whereMany(['supplier_name' => $data['supplier_name']]);
        if (!empty($existing)) {
            setSweetAlert('error', 'Duplicate Supplier', 'A supplier with this name already exists.');
            redirect('/admin/supplier/create');
        }

        $result = Supplier::insert($data);

        if ($result) {
            setSweetAlert('success', 'Success!', 'Supplier added successfully.');
            redirect('/admin/supplier');
        } else {
            setSweetAlert('error', 'Error!', 'Failed to add supplier.');
            redirect('/admin/supplier/create');
        }
    }

    /**
     * Show supplier details
     */
    public function show($id)
    {
        $supplier = $this->findOrFailSupplier($id);

        // Get inventory items for this supplier
        $inventoryCount = $supplier->inventoryCount();

        $data = [
            'title' => 'Supplier Details',
            'supplier' => $supplier,
            'inventoryCount' => $inventoryCount
        ];

        return $this->view('admin/supplier/show', $data);
    }

    /**
     * Show edit supplier form
     */
    public function edit($id)
    {
        $supplier = $this->findOrFailSupplier($id);

        $data = [
            'title' => 'Edit Supplier',
            'supplier' => $supplier
        ];

        return $this->view('admin/supplier/update', $data);
    }

    /**
     * Update supplier
     */
    public function update(Request $request, $id)
    {
        $supplier = $this->findOrFailSupplier($id);

        $data = $request->validate([
            'supplier_name' => 'required',
            'contact_person' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'status' => 'required'
        ]);

        // Check if supplier name already exists (excluding current supplier)
        $existing = Supplier::whereMany(['supplier_name' => $data['supplier_name']]);
        foreach ($existing as $existingSupplier) {
            if ($existingSupplier->id != $id) {
                setSweetAlert('error', 'Duplicate Supplier', 'A supplier with this name already exists.');
                redirect('/admin/supplier/' . $id . '/edit');
            }
        }

        $result = Supplier::update($id, $data);

        if ($result) {
            setSweetAlert('success', 'Success!', 'Supplier updated successfully.');
            redirect('/admin/supplier/' . $id);
        } else {
            setSweetAlert('error', 'Error!', 'Failed to update supplier.');
            redirect('/admin/supplier/' . $id . '/edit');
        }
    }

    /**
     * Show delete confirmation
     */
    public function delete($id)
    {
        $supplier = $this->findOrFailSupplier($id);

        // Check if supplier has inventory items
        $inventoryCount = $supplier->inventoryCount();

        $data = [
            'title' => 'Delete Supplier',
            'supplier' => $supplier,
            'inventoryCount' => $inventoryCount
        ];

        return $this->view('admin/supplier/delete', $data);
    }

    /**
     * Delete supplier
     */
    public function destroy($id)
    {
        $supplier = $this->findOrFailSupplier($id);

        // Check if supplier has inventory items
        $inventoryCount = $supplier->inventoryCount();
        if ($inventoryCount > 0) {
            setSweetAlert('error', 'Cannot Delete', 'This supplier has ' . $inventoryCount . ' inventory item(s). Please reassign or delete them first.');
            redirect('/admin/supplier/' . $id . '/delete');
        }

        $result = Supplier::delete($id);

        if ($result) {
            setSweetAlert('success', 'Success!', 'Supplier deleted successfully.');
            redirect('/admin/supplier');
        } else {
            setSweetAlert('error', 'Error!', 'Failed to delete supplier.');
            redirect('/admin/supplier/' . $id . '/delete');
        }
    }

    public function findOrFailSupplier($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            setSweetAlert('error', 'Not Found', 'Supplier not found.');
            redirect('/admin/supplier');
        }

        return $supplier;
    }
}
