<?php layout('admin/header') ?>

<div class="flex items-start justify-between mb-8">
    <div class="flex-1">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">Delete Supplier</h1>
        <p class="text-gray-600">Are you sure you want to delete this supplier? This action cannot be undone.</p>
    </div>
    <div class="flex space-x-3">
        <a href="/admin/supplier"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#815331] transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>
</div>

<!-- Supplier Details Section -->
<div>
    <!-- Warning Alert -->
    <?php if ($inventoryCount > 0): ?>
    <div class="p-4 mb-8 border border-red-200 rounded-lg bg-red-50">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Cannot Delete Supplier</h3>
                <div class="mt-2 text-sm text-red-700">
                    <p>This supplier has <strong><?= $inventoryCount ?></strong> inventory item(s) associated with it. Please reassign or delete these items before deleting the supplier.</p>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="p-4 mb-8 border border-red-200 rounded-lg bg-red-50">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Warning</h3>
                <div class="mt-2 text-sm text-red-700">
                    <p>This action will permanently delete the supplier and cannot be undone. Please review the details below before confirming.</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- 2-Column Grid Layout -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

        <!-- Left Column -->
        <div class="space-y-6">
            <h3 class="pb-2 text-lg font-semibold text-gray-900 border-b border-gray-200">Basic Information</h3>

            <!-- ID -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Supplier ID</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    #<?= str_pad($supplier->id, 4, '0', STR_PAD_LEFT) ?>
                </div>
            </div>

            <!-- Supplier Name -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Supplier Name</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?= htmlspecialchars($supplier->supplier_name) ?>
                </div>
            </div>

            <!-- Contact Person -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Contact Person</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?= $supplier->contact_person ? htmlspecialchars($supplier->contact_person) : 'Not provided' ?>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Address</label>
                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 min-h-[100px]">
                    <?= $supplier->address ? nl2br(htmlspecialchars($supplier->address)) : 'No address provided' ?>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="grid grid-cols-1 gap-4">
                <div class="form-group">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Created At</label>
                    <div class="w-full px-4 py-3 text-sm text-gray-600 border border-gray-200 rounded-lg bg-gray-50">
                        <?= date('M d, Y \a\t g:i A', strtotime($supplier->created_at)) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Last Updated</label>
                    <div class="w-full px-4 py-3 text-sm text-gray-600 border border-gray-200 rounded-lg bg-gray-50">
                        <?= date('M d, Y \a\t g:i A', strtotime($supplier->updated_at)) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <h3 class="pb-2 text-lg font-semibold text-gray-900 border-b border-gray-200">Contact Information</h3>

            <!-- Email -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?= $supplier->email ? htmlspecialchars($supplier->email) : 'Not provided' ?>
                </div>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?= $supplier->phone ? htmlspecialchars($supplier->phone) : 'Not provided' ?>
                </div>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?php if ($supplier->status === 'active'): ?>
                        <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold min-w-[100px] bg-emerald-500 text-white">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Active
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold min-w-[100px] bg-gray-400 text-white">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            Inactive
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Inventory Items Count -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Associated Inventory Items</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <span class="font-semibold"><?= $inventoryCount ?></span> <?= $inventoryCount === 1 ? 'item' : 'items' ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="pt-6 mt-8 border-t border-gray-200">
        <div class="flex items-center justify-end space-x-4">
            <a href="/admin/supplier"
                class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#815331] transition-colors">
                Cancel
            </a>
            <?php if ($inventoryCount === 0): ?>
            <form action="/admin/supplier/<?= $supplier->id ?>/destroy" method="post" class="inline">
                <?= csrf_token() ?>
                <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white transition-colors bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete Supplier
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php layout('admin/footer') ?>
