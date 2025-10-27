<div id="content-sales" class="tab-content hidden">
    <div class="grid grid-cols-1 gap-6">
        <!-- Sales Summary Cards -->
        <div class="grid grid-cols-4 gap-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Orders</p>
                        <p><?= $salesSummary['total_orders'] ?></p>
                    </div>
                    <div class="icon-admin">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1" />
                            <circle cx="19" cy="21" r="1" />
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                        <p>₱<?= number_format($salesSummary['total_revenue'], 2) ?></p>
                    </div>
                    <div class="icon-admin">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                            <path d="M12 16v5" />
                            <path d="M16 14v7" />
                            <path d="M20 10v11" />
                            <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                            <path d="M4 18v3" />
                            <path d="M8 14v7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Completed Orders</p>
                        <p><?= $salesSummary['completed_orders'] ?></p>
                    </div>
                    <div class="icon-admin bg-green-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check-icon lucide-badge-check">
                            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Completion Rate</p>
                        <p><?= number_format($salesSummary['completion_rate'], 1) ?>%</p>
                    </div>
                    <div class="icon-admin bg-blue-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-percent-icon lucide-percent">
                            <line x1="19" x2="5" y1="5" y2="19" />
                            <circle cx="6.5" cy="6.5" r="2.5" />
                            <circle cx="17.5" cy="17.5" r="2.5" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Selling Items -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star">
                        <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                    </svg>
                    Top 10 Selling Items
                </h3>
                <p class="text-sm text-gray-600 mt-1">Best performing products</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="topSellingTable">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Rank</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Item Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Category</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Quantity Sold</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($topSellingItems)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No sales data available</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($topSellingItems as $index => $item): ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 <?= $index < 3 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' ?> rounded-full text-xs font-semibold">
                                            #<?= $index + 1 ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-gray-900">#<?= str_pad($item['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="truncate-text" title="<?= htmlspecialchars($item['name']) ?>">
                                            <?= htmlspecialchars(strlen($item['name']) > 30 ? substr($item['name'], 0, 30) . '...' : $item['name']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($item['category']) ?></td>
                                    <td class="px-6 py-4 font-semibold text-gray-900"><?= $item['quantity_sold'] ?> units</td>
                                    <td class="px-6 py-4 font-semibold" style="color: #815331;">₱<?= number_format($item['revenue'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($topSellingItems) > 10): ?>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span id="topSellingStart">1</span> to <span id="topSellingEnd">10</span> of <?= count($topSellingItems) ?> items
                    </div>
                    <div class="flex gap-2" id="topSellingPagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        paginateTable('topSellingTable', 'topSellingPagination', 'topSellingStart', 'topSellingEnd');
    });
</script>