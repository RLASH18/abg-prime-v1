<?php layout('admin/header') ?>

<!-- Header section -->
<div class="flex justify-between items-start mb-8">
    <div class="flex-1">
        <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">Supplier Masterlist</h1>
        <p class="text-gray-600 text-base font-normal">Manage your suppliers and their information</p>
    </div>
    <button class="bg-[#815331] hover:bg-[#5f3e27] text-white px-5 py-3 rounded-lg font-medium text-sm">
        <a href="/admin/supplier/create" class="text-white no-underline">Add Supplier</a>
    </button>
</div>

<!-- Search and Filter Section -->
<div class="flex gap-4 mb-6 items-center">
    <div class="relative flex-1">
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
        </svg>
        <input type="text" id="supplier-search" placeholder="Search suppliers..." class="w-full pl-11 pr-3 py-3 border border-gray-300 rounded-lg text-sm bg-white transition-all duration-200 focus:outline-none focus:border-[#815331] focus:ring-3 focus:ring-[#5f3e27]">
    </div>
    <div class="flex gap-3">
        <select id="status-filter" class="px-4 py-3 border border-gray-300 rounded-lg bg-white text-sm text-gray-700 cursor-pointer transition-all duration-200 min-w-[140px] focus:outline-none focus:border-[#815331] focus:ring-3 focus:ring-[#5f3e27]">
            <option value="">All Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>
</div>

<!-- Suppliers table -->
<div class="custom-datatable bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200">
    <table id="suppliers-table" class="w-full border-collapse table-fixed text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">ID</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Supplier Name</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Contact Person</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Email</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Phone</th>
                <th class="px-6 py-4 text-center font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Status</th>
                <th class="px-6 py-4 text-center font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
                <tr class="h-16 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-900 font-semibold font-mono align-middle">#<?= str_pad($supplier->id, 4, '0', STR_PAD_LEFT) ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-900 font-semibold align-middle">
                        <span class="block truncate max-w-[200px]" title="<?= htmlspecialchars($supplier->supplier_name) ?>">
                            <?= htmlspecialchars($supplier->supplier_name) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-600 font-medium align-middle">
                        <?= $supplier->contact_person ? htmlspecialchars($supplier->contact_person) : '<span class="text-gray-400">N/A</span>' ?>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-600 font-medium align-middle">
                        <?php if ($supplier->email): ?>
                            <span class="block truncate max-w-[180px]" title="<?= htmlspecialchars($supplier->email) ?>">
                                <?= htmlspecialchars($supplier->email) ?>
                            </span>
                        <?php else: ?>
                            <span class="text-gray-400">N/A</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-600 font-medium align-middle">
                        <?= $supplier->phone ? htmlspecialchars($supplier->phone) : '<span class="text-gray-400">N/A</span>' ?>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-100 align-middle">
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
                    </td>
                    <td class="px-6 py-4 border-b border-gray-100 align-middle">
                        <div class="flex gap-2 items-center">
                            <a href="/admin/supplier/<?= $supplier->id ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-200 text-gray-600 bg-gray-100 border border-gray-200 hover:text-white hover:bg-[#815331] hover:border-[#815331] hover:-translate-y-0.5" title="View">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                            <a href="/admin/supplier/<?= $supplier->id ?>/edit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-200 text-white bg-blue-500 border border-blue-500 hover:bg-blue-600 hover:border-blue-600 hover:-translate-y-0.5" title="Edit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                            <a href="/admin/supplier/<?= $supplier->id ?>/delete" class="inline-flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-200 text-white bg-red-500 border border-red-500 hover:bg-red-600 hover:border-red-600 hover:-translate-y-0.5" title="Delete">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3,6 5,6 21,6"></polyline>
                                    <path d="M19,6V20a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6M8,6V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        const table = $('#suppliers-table').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            order: [[0, 'desc']],
            columnDefs: [{
                orderable: false,
                searchable: false,
                targets: -1
            }],
            dom: '<"datatable-controls"<"datatable-length"l><"datatable-info"i>>rt<"datatable-footer"<"datatable-pagination"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ suppliers",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });

        // Custom search functionality
        $('#supplier-search').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Status filter
        $('#status-filter').on('change', function() {
            table.column(5).search(this.value).draw();
        });
    });
</script>

<?php layout('admin/footer') ?>
