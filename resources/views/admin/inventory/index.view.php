<?php layout('admin/header') ?>

<!-- Header section -->
<div class="flex justify-between items-start mb-8">
    <div class="flex-1">
        <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">Inventory</h1>
        <p class="text-gray-600 text-base font-normal">Monitor and manage your stock levels</p>
    </div>
    <button class="bg-[#815331] hover:bg-[#5f3e27] text-white px-5 py-3 rounded-lg font-medium text-sm">
        <a href="/admin/inventory/create" class="text-white no-underline">Add Item</a>
    </button>
</div>

<?php 
// Calculate low stock items
$lowStockItems = [];
$outOfStockItems = [];
foreach ($inventory as $item) {
    if ($item->quantity <= 0) {
        $outOfStockItems[] = $item;
    } elseif ($item->quantity <= $item->restock_threshold) {
        $lowStockItems[] = $item;
    }
}
$totalAlerts = count($lowStockItems) + count($outOfStockItems);
?>

<!-- Stock Alert Banner -->
<?php if ($totalAlerts > 0): ?>
<div class="bg-yellow-50 border-yellow-200 text-yellow-800 border rounded-lg p-4 mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium">Stock Level Alert</h3>
                <div class="mt-1 text-sm">
                    <p>
                        <?php if (count($outOfStockItems) > 0): ?>
                            <span class="font-semibold"><?= count($outOfStockItems) ?></span> item<?= count($outOfStockItems) > 1 ? 's' : '' ?> out of stock
                            <?php if (count($lowStockItems) > 0): ?>
                                and <span class="font-semibold"><?= count($lowStockItems) ?></span> item<?= count($lowStockItems) > 1 ? 's' : '' ?> running low
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="font-semibold"><?= count($lowStockItems) ?></span> item<?= count($lowStockItems) > 1 ? 's' : '' ?> running low on stock
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
        <button onclick="showStockAlertModal()" class="flex-shrink-0 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            View Details
        </button>
    </div>
</div>
<?php endif; ?>

<!-- Stock Alert Modal -->
<div id="stockAlertModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50" id="stockAlertBackdrop"></div>
    
    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="relative w-full bg-white rounded-lg shadow-xl" style="max-width: 700px;">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b sm:p-6">
                <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">Stock Alert - Items Needing Restock</h2>
                <button type="button" id="closeStockAlertModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 overflow-y-auto sm:p-6 max-h-96 sm:max-h-[500px]">
            <?php if (count($outOfStockItems) > 0): ?>
            <!-- Out of Stock Section -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-red-600 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414-1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    Out of Stock (<?= count($outOfStockItems) ?>)
                </h3>
                <div class="space-y-2">
                    <?php foreach ($outOfStockItems as $item): ?>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-center gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-900 truncate" title="<?= htmlspecialchars($item->item_name) ?>">
                                <?= strlen($item->item_name) > 40 ? substr($item->item_name, 0, 40) . '...' : $item->item_name ?>
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                <span class="font-medium">Code:</span> <?= $item->item_code ?> | 
                                <span class="font-medium">Category:</span> <?= $item->category ?>
                            </div>
                        </div>
                        <div class="text-center flex-shrink-0" style="min-width: 70px;">
                            <div class="text-2xl font-bold text-red-600">0</div>
                            <div class="text-xs text-gray-500">Threshold: <?= $item->restock_threshold ?></div>
                        </div>
                        <a href="/admin/inventory/edit/<?= $item->id ?>" class="flex-shrink-0 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
                            Restock Now
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (count($lowStockItems) > 0): ?>
            <!-- Low Stock Section -->
            <div>
                <h3 class="text-lg font-bold text-amber-600 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Low Stock Warning (<?= count($lowStockItems) ?>)
                </h3>
                <div class="space-y-2">
                    <?php foreach ($lowStockItems as $item): ?>
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 flex items-center gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-900 truncate" title="<?= htmlspecialchars($item->item_name) ?>">
                                <?= strlen($item->item_name) > 40 ? substr($item->item_name, 0, 40) . '...' : $item->item_name ?>
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                <span class="font-medium">Code:</span> <?= $item->item_code ?> | 
                                <span class="font-medium">Category:</span> <?= $item->category ?>
                            </div>
                        </div>
                        <div class="text-center flex-shrink-0" style="min-width: 70px;">
                            <div class="text-2xl font-bold text-amber-600"><?= $item->quantity ?></div>
                            <div class="text-xs text-gray-500">Threshold: <?= $item->restock_threshold ?></div>
                        </div>
                        <a href="/admin/inventory/edit/<?= $item->id ?>" class="flex-shrink-0 bg-amber-600 hover:bg-amber-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
                            Restock
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($totalAlerts === 0): ?>
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">All Stock Levels Good!</h3>
                <p class="text-gray-600">No items currently need restocking.</p>
            </div>
            <?php endif; ?>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 p-4 border-t sm:p-6">
                <button type="button" onclick="closeStockAlertModal()" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 sm:text-base">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="flex gap-4 mb-6 items-center">
    <div class="relative flex-1">
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
        </svg>
        <input type="text" id="inventory-search" placeholder="Search items or categories..." class="w-full pl-11 pr-3 py-3 border border-gray-300 rounded-lg text-sm bg-white transition-all duration-200 focus:outline-none focus:border-[#815331] focus:ring-3 focus:ring-[#5f3e27]">
    </div>
    <div class="flex gap-3">
        <select id="category-filter" class="px-4 py-3 border border-gray-300 rounded-lg bg-white text-sm text-gray-700 cursor-pointer transition-all duration-200 min-w-[180px] focus:outline-none focus:border-[#815331] focus:ring-3 focus:ring-[#5f3e27]">
            <option value="">All Categories</option>
            <option value="Hand Tools">Hand Tools</option>
            <option value="Power Tools">Power Tools</option>
            <option value="Construction Materials">Construction Materials</option>
            <option value="Locks and Security">Locks and Security</option>
            <option value="Plumbing">Plumbing</option>
            <option value="Electrical">Electrical</option>
            <option value="Paint and Finishes">Paint and Finishes</option>
            <option value="Chemicals">Chemicals</option>
        </select>
        <select id="stock-filter" class="px-4 py-3 border border-gray-300 rounded-lg bg-white text-sm text-gray-700 cursor-pointer transition-all duration-200 min-w-[140px] focus:outline-none focus:border-[#815331] focus:ring-3 focus:ring-[#5f3e27]">
            <option value="">All Stock</option>
            <option value="low">Low Stock</option>
            <option value="medium">Warning</option>
            <option value="high">In Stock</option>
        </select>
    </div>
</div>

<!-- Inventory table -->
<div class="custom-datatable bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200">
    <table id="inventory-table" class="w-full border-collapse table-fixed text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">ID</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Item Code</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Item name</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Category</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Unit price</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Quantity</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Restock Threshold</th>
                <th class="px-6 py-4 text-center font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Status</th>
                <th class="px-6 py-4 text-center font-semibold text-gray-700 text-xs uppercase tracking-wide border-b border-gray-200">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $item): ?>
                <tr class="h-16 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-900 font-semibold font-mono align-middle">#<?= str_pad($item->id, 4, '0', STR_PAD_LEFT) ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-700 font-semibold align-middle"><?= $item->item_code ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-900 font-semibold align-middle truncate" title="<?= $item->item_name ?>"><?= $item->item_name ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-600 font-medium align-middle"><?= $item->category ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-[#815331] font-bold text-base align-middle">₱<?= number_format($item->unit_price, 2) ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-900 font-semibold !text-left align-middle"><?= $item->quantity ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 text-gray-600 font-medium !text-left align-middle"><?= $item->restock_threshold ?></td>
                    <td class="px-6 py-4 border-b border-gray-100 align-middle">
                        <?php if ($item->quantity <= 0): ?>
                            <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold min-w-[100px] bg-red-500 text-white">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Out of Stock
                            </span>
                        <?php elseif ($item->quantity <= $item->restock_threshold): ?>
                            <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold min-w-[100px] bg-amber-500 text-white">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Warning
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold min-w-[100px] bg-emerald-500 text-white">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                In Stock
                            </span>
                        <?php endif ?>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-100 align-middle">
                        <div class="flex gap-2 items-center">
                            <a href="/admin/inventory/show/<?= $item->id ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-200 text-gray-600 bg-gray-100 border border-gray-200 hover:text-white hover:bg-[#815331] hover:border-[#815331] hover:-translate-y-0.5" title="View">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                            <a href="/admin/inventory/edit/<?= $item->id ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-200 text-white bg-blue-500 border border-blue-500 hover:bg-blue-600 hover:border-blue-600 hover:-translate-y-0.5" title="Edit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                            <a href="/admin/inventory/delete/<?= $item->id ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-200 text-white bg-red-500 border border-red-500 hover:bg-red-600 hover:border-red-600 hover:-translate-y-0.5" title="Delete">
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
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    // Stock Alert Modal Functions
    function showStockAlertModal() {
        const modal = document.getElementById('stockAlertModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeStockAlertModal() {
        const modal = document.getElementById('stockAlertModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Initialize modal event listeners when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        const stockAlertBackdrop = document.getElementById('stockAlertBackdrop');
        const closeStockAlertBtn = document.getElementById('closeStockAlertModal');

        // Close modal when clicking backdrop
        if (stockAlertBackdrop) {
            stockAlertBackdrop.addEventListener('click', closeStockAlertModal);
        }

        // Close modal when clicking X button
        if (closeStockAlertBtn) {
            closeStockAlertBtn.addEventListener('click', closeStockAlertModal);
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('stockAlertModal');
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeStockAlertModal();
            }
        });
    });

    $(document).ready(function() {
        const table = $('#inventory-table').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: -1
                },
                {
                    className: "dt-head-left",
                    targets: [4, 5]
                } // Quantity & Threshold
            ],
            dom: '<"datatable-controls"<"datatable-length"l><"datatable-info"i>>rt<"datatable-footer"<"datatable-pagination"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ items",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });

        // Custom search functionality
        $('#inventory-search').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Category filter
        $('#category-filter').on('change', function() {
            table.column(2).search(this.value).draw();
        });
        
        // Stock level filter
        $('#stock-filter').on('change', function() {
            const value = this.value;
            if (value === '') {
                table.column(7).search('').draw();
            } else if (value === 'low') {
                table.column(7).search('Out of Stock').draw();
            } else if (value === 'medium') {
                table.column(7).search('Warning').draw();
            } else if (value === 'high') {
                table.column(7).search('In Stock').draw();
            }
        });
    });
</script>

<?php layout('admin/footer') ?>