<?php layout('admin/header') ?>

<!-- Header Section -->
<div class="flex items-start justify-between mb-8">
    <div class="flex-1">
        <h1 class="mb-2 text-3xl font-bold leading-tight text-gray-900">Edit Supplier</h1>
        <p class="text-base font-normal text-gray-600">Update the details below to modify the supplier information</p>
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

<!-- Form Section -->
<form action="/admin/supplier/<?= $supplier->id ?>/update" method="POST">
    <?= csrf_token() ?>

    <!-- 2-Column Grid Layout -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

        <!-- Left Column -->
        <div class="space-y-6">
            <h3 class="pb-2 text-lg font-semibold text-gray-900 border-b border-gray-200">Basic Information</h3>

            <!-- Supplier Name -->
            <div>
                <label for="supplier_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Supplier Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="supplier_name" name="supplier_name" value="<?= old('supplier_name') ?: $supplier->supplier_name ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#815331] focus:border-transparent transition-all <?= isInvalid('supplier_name') ? 'border-red-300 bg-red-50' : '' ?>"
                    placeholder="Enter supplier name">
                <div class="mt-2 text-xs text-left text-red-500">
                    <p><?= error('supplier_name') ?></p>
                </div>
            </div>

            <!-- Contact Person -->
            <div>
                <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-2">
                    Contact Person
                </label>
                <input type="text" id="contact_person" name="contact_person"
                    value="<?= old('contact_person') ?: $supplier->contact_person ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#815331] focus:border-transparent transition-all <?= isInvalid('contact_person') ? 'border-red-300 bg-red-50' : '' ?>"
                    placeholder="Enter contact person name">
                <div class="mt-2 text-xs text-left text-red-500">
                    <p><?= error('contact_person') ?></p>
                </div>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                    Address
                </label>
                <textarea id="address" name="address" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#815331] focus:border-transparent transition-all resize-none <?= isInvalid('address') ? 'border-red-300 bg-red-50' : '' ?>"
                    placeholder="Enter complete address"><?= old('address') ?: $supplier->address ?></textarea>
                <div class="mt-2 text-xs text-left text-red-500">
                    <p><?= error('address') ?></p>
                </div>
            </div>
        </div>

        <!-- Right Column: Contact Information -->
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b border-gray-200">Contact Information</h2>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>
                <input type="email" id="email" name="email" value="<?= old('email') ?: $supplier->email ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#815331] focus:border-transparent transition-all <?= isInvalid('email') ? 'border-red-300 bg-red-50' : '' ?>"
                    placeholder="supplier@example.com">
                <div class="mt-2 text-xs text-left text-red-500">
                    <p><?= error('email') ?></p>
                </div>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    Phone Number
                </label>
                <input type="text" id="phone" name="phone"
                    value="<?= old('phone') ?: $supplier->phone ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#815331] focus:border-transparent transition-all <?= isInvalid('phone') ? 'border-red-300 bg-red-50' : '' ?>"
                    placeholder="+63 XXX XXX XXXX">
                <div class="mt-2 text-xs text-left text-red-500">
                    <p><?= error('phone') ?></p>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#815331] focus:border-transparent transition-all <?= isInvalid('status') ? 'border-red-300 bg-red-50' : '' ?>">
                    <option value="active" <?= (old('status') ?: $supplier->status) === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= (old('status') ?: $supplier->status) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
                <div class="mt-2 text-xs text-left text-red-500">
                    <p><?= error('status') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="pt-6 mt-8 border-t border-gray-200">
        <div class="flex items-center justify-end space-x-4">
            <a href="/admin/supplier"
                class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#815331] transition-colors">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#815331] hover:bg-[#6b4428] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#815331] transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Update Supplier
            </button>
        </div>
    </div>
</form>

<?php layout('admin/footer') ?>