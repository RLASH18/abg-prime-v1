<div id="content-inventory" class="tab-content">
    <div class="grid grid-cols-1 gap-6">
        <!-- Low Stock Items -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-orange-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-orange-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                    </svg>
                    Low Stock Alert
                </h3>
                <p class="text-sm text-gray-600 mt-1"><?= count($lowStockItems) ?> items below restock threshold</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="lowStockTable">
                    <thead class="bg-orange-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Category</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Current Stock</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Threshold</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Supplier</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($lowStockItems)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 mx-auto mb-2 text-green-500">
                                        <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z"/>
                                    </svg>
                                    All items have sufficient stock!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($lowStockItems as $item): ?>
                                <tr class="border-b border-gray-100 hover:bg-orange-50">
                                    <td class="px-6 py-4 font-mono text-gray-900">#<?= str_pad($item['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="truncate-text" title="<?= htmlspecialchars($item['name']) ?>">
                                            <?= htmlspecialchars(strlen($item['name']) > 30 ? substr($item['name'], 0, 30) . '...' : $item['name']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($item['category']) ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">
                                            <?= $item['quantity'] ?> units
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600"><?= $item['threshold'] ?> units</td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <span class="truncate-text" title="<?= htmlspecialchars($item['supplier']) ?>">
                                            <?= htmlspecialchars(strlen($item['supplier']) > 20 ? substr($item['supplier'], 0, 20) . '...' : $item['supplier']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="/admin/inventory/edit/<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                                            Restock
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($lowStockItems) > 10): ?>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span id="lowStockStart">1</span> to <span id="lowStockEnd">10</span> of <?= count($lowStockItems) ?> items
                    </div>
                    <div class="flex gap-2" id="lowStockPagination"></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Out of Stock Items -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                        <path d="m7.5 4.27 9 5.15" />
                        <polyline points="3.29 7 12 12 20.71 7" />
                        <line x1="12" x2="12" y1="22" y2="12" />
                        <path d="m17 13 5 5m-5 0 5-5" />
                    </svg>
                    Out of Stock
                </h3>
                <p class="text-sm text-gray-600 mt-1"><?= count($outOfStockItems) ?> items completely out of stock</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="outOfStockTable">
                    <thead class="bg-red-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Category</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Supplier</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($outOfStockItems)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 mx-auto mb-2 text-green-500">
                                        <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z"/>
                                    </svg>
                                    No items are out of stock!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($outOfStockItems as $item): ?>
                                <tr class="border-b border-gray-100 hover:bg-red-50">
                                    <td class="px-6 py-4 font-mono text-gray-900">#<?= str_pad($item['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="truncate-text" title="<?= htmlspecialchars($item['name']) ?>">
                                            <?= htmlspecialchars(strlen($item['name']) > 30 ? substr($item['name'], 0, 30) . '...' : $item['name']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($item['category']) ?></td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <span class="truncate-text" title="<?= htmlspecialchars($item['supplier']) ?>">
                                            <?= htmlspecialchars(strlen($item['supplier']) > 20 ? substr($item['supplier'], 0, 20) . '...' : $item['supplier']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="/admin/inventory/edit/<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                                            Restock Now
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($outOfStockItems) > 10): ?>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span id="outOfStockStart">1</span> to <span id="outOfStockEnd">10</span> of <?= count($outOfStockItems) ?> items
                    </div>
                    <div class="flex gap-2" id="outOfStockPagination"></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Overstocked Items -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                        <path d="m3.3 7 8.7 5 8.7-5" />
                        <path d="M12 22V12" />
                    </svg>
                    Overstocked Items
                </h3>
                <p class="text-sm text-gray-600 mt-1"><?= count($overstockedItems) ?> items with excessive stock</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="overstockedTable">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Category</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Current Stock</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Threshold</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Excess</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($overstockedItems)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    No overstocked items found
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($overstockedItems as $item): ?>
                                <tr class="border-b border-gray-100 hover:bg-blue-50">
                                    <td class="px-6 py-4 font-mono text-gray-900">#<?= str_pad($item['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="truncate-text" title="<?= htmlspecialchars($item['name']) ?>">
                                            <?= htmlspecialchars(strlen($item['name']) > 30 ? substr($item['name'], 0, 30) . '...' : $item['name']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($item['category']) ?></td>
                                    <td class="px-6 py-4 text-gray-900 font-semibold"><?= $item['quantity'] ?> units</td>
                                    <td class="px-6 py-4 text-gray-600"><?= $item['threshold'] ?> units</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                            +<?= $item['excess'] ?> excess
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($overstockedItems) > 10): ?>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span id="overstockedStart">1</span> to <span id="overstockedEnd">10</span> of <?= count($overstockedItems) ?> items
                    </div>
                    <div class="flex gap-2" id="overstockedPagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Simple pagination function
function paginateTable(tableId, paginationId, startId, endId, itemsPerPage = 10) {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr')).filter(row => !row.querySelector('td[colspan]'));
    const totalItems = rows.length;
    
    if (totalItems <= itemsPerPage) return;
    
    let currentPage = 1;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    
    function showPage(page) {
        currentPage = page;
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        
        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });
        
        document.getElementById(startId).textContent = start + 1;
        document.getElementById(endId).textContent = Math.min(end, totalItems);
        
        renderPagination();
    }
    
    function renderPagination() {
        const container = document.getElementById(paginationId);
        if (!container) return;
        
        container.innerHTML = '';
        
        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.textContent = '‹';
        prevBtn.className = 'px-3 py-1 rounded border ' + (currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50');
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => currentPage > 1 && showPage(currentPage - 1);
        container.appendChild(prevBtn);
        
        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                pageBtn.className = 'px-3 py-1 rounded border ' + (i === currentPage ? 'bg-[#815331] text-white' : 'bg-white text-gray-700 hover:bg-gray-50');
                pageBtn.onclick = () => showPage(i);
                container.appendChild(pageBtn);
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = 'px-2 text-gray-500';
                container.appendChild(dots);
            }
        }
        
        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.textContent = '›';
        nextBtn.className = 'px-3 py-1 rounded border ' + (currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50');
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => currentPage < totalPages && showPage(currentPage + 1);
        container.appendChild(nextBtn);
    }
    
    showPage(1);
}

// Initialize pagination when inventory tab is shown
document.addEventListener('DOMContentLoaded', function() {
    paginateTable('lowStockTable', 'lowStockPagination', 'lowStockStart', 'lowStockEnd');
    paginateTable('outOfStockTable', 'outOfStockPagination', 'outOfStockStart', 'outOfStockEnd');
    paginateTable('overstockedTable', 'overstockedPagination', 'overstockedStart', 'overstockedEnd');
});
</script>
