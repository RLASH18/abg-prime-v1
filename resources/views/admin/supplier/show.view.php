<?php layout('admin/header') ?>

<div class="flex items-start justify-between mb-8">
    <div class="flex-1">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">Supplier Details</h1>
        <p class="text-gray-600">View detailed information about this supplier</p>
    </div>
    <div class="flex space-x-3">
        <a href="/admin/supplier"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#815331] transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Suppliers
        </a>
    </div>
</div>

<div>

    <!-- Status Alert -->
    <?php if ($supplier->status === 'active'): ?>
        <div class="bg-green-50 border-green-200 text-green-800 border rounded-lg p-4 mb-8">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium">Active Supplier</h3>
                    <div class="mt-1 text-sm">
                        <p>This supplier is currently active and available for orders</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-gray-50 border-gray-200 text-gray-800 border rounded-lg p-4 mb-8">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium">Inactive Supplier</h3>
                    <div class="mt-1 text-sm">
                        <p>This supplier is currently inactive</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

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
                <div class="w-full px-4 py-3 text-[#815331] font-bold border border-gray-200 rounded-lg bg-gray-50">
                    <?= $supplier->supplier_name ?>
                </div>
            </div>

            <!-- Contact Person -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Contact Person</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?= $supplier->contact_person ? $supplier->contact_person : '<span class="text-gray-400">Not provided</span>' ?>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Address</label>
                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 min-h-[100px] whitespace-pre-wrap">
                    <?= $supplier->address ? $supplier->address : '<span class="text-gray-400">No address provided</span>' ?>
                </div>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <div class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50">
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
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <h3 class="pb-2 text-lg font-semibold text-gray-900 border-b border-gray-200">Contact & Additional Info</h3>

            <!-- Email -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?php if ($supplier->email): ?>
                        <a href="mailto:<?= htmlspecialchars($supplier->email) ?>" class="text-[#815331] hover:underline font-medium">
                            <?= $supplier->email ?>
                        </a>
                    <?php else: ?>
                        <span class="text-gray-400">Not provided</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                <div class="w-full px-4 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50">
                    <?php if ($supplier->phone): ?>
                            <?= $supplier->phone ?>
                        </a>
                    <?php else: ?>
                        <span class="text-gray-400">Not provided</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Inventory Count -->
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-700">Inventory Items</label>
                <div class="w-full px-4 py-3 text-[#815331] font-bold border border-gray-200 rounded-lg bg-gray-50">
                    <?= $inventoryCount ?> <?= $inventoryCount === 1 ? 'item' : 'items' ?>
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
    </div>

    <!-- Action Buttons -->
    <div class="pt-6 mt-8 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex space-x-4">
                <a href="/admin/supplier"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#815331] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Suppliers
                </a>
            </div>
        </div>
    </div>
</div>

<?php layout('admin/footer') ?>
