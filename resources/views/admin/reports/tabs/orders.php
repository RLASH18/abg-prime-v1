<div id="content-orders" class="tab-content hidden">
    <div class="grid grid-cols-1 gap-6">
        <!-- Pending Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock">
                        <path d="M12 6v6l4 2" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    Pending Orders
                </h3>
                <p class="text-sm text-gray-600 mt-1"><?= count($pendingOrders) ?> orders awaiting confirmation</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="pendingOrdersTable">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Order ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Customer</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Total Amount</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Days Pending</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Order Date</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pendingOrders)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No pending orders</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pendingOrders as $order): ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-mono text-gray-900">#<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="truncate-text" title="<?= htmlspecialchars($order['customer']) ?>">
                                            <?= htmlspecialchars(strlen($order['customer']) > 25 ? substr($order['customer'], 0, 25) . '...' : $order['customer']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 font-semibold">₱<?= number_format($order['total'], 2) ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 <?= $order['days_pending'] > 3 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' ?> rounded-full text-xs font-semibold">
                                            <?= $order['days_pending'] ?> days
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600"><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                    <td class="px-6 py-4">
                                        <a href="/admin/orders/<?= $order['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">Review</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($pendingOrders) > 10): ?>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span id="pendingOrdersStart">1</span> to <span id="pendingOrdersEnd">10</span> of <?= count($pendingOrders) ?> orders
                    </div>
                    <div class="flex gap-2" id="pendingOrdersPagination"></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Cancelled Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="m15 9-6 6" />
                        <path d="m9 9 6 6" />
                    </svg>
                    Recently Cancelled Orders
                </h3>
                <p class="text-sm text-gray-600 mt-1">Last 10 cancelled orders</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="cancelledOrdersTable">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Order ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Customer</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Total Amount</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Cancelled Date</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($cancelledOrders)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">No cancelled orders</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($cancelledOrders as $order): ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-mono text-gray-900">#<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="truncate-text" title="<?= htmlspecialchars($order['customer']) ?>">
                                            <?= htmlspecialchars(strlen($order['customer']) > 25 ? substr($order['customer'], 0, 25) . '...' : $order['customer']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">₱<?= number_format($order['total'], 2) ?></td>
                                    <td class="px-6 py-4 text-gray-600"><?= date('M d, Y', strtotime($order['cancelled_at'])) ?></td>
                                    <td class="px-6 py-4">
                                        <a href="/admin/orders/<?= $order['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">View Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (count($cancelledOrders) > 10): ?>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span id="cancelledOrdersStart">1</span> to <span id="cancelledOrdersEnd">10</span> of <?= count($cancelledOrders) ?> orders
                    </div>
                    <div class="flex gap-2" id="cancelledOrdersPagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        paginateTable('pendingOrdersTable', 'pendingOrdersPagination', 'pendingOrdersStart', 'pendingOrdersEnd');
        paginateTable('cancelledOrdersTable', 'cancelledOrdersPagination', 'cancelledOrdersStart', 'cancelledOrdersEnd');
    });
</script>