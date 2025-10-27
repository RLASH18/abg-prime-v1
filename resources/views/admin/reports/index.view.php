<?php layout('admin/header') ?>

<div class="flex justify-between items-start mb-8">
    <div class="flex-1">
        <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">Reports & Validation</h1>
        <p class="text-gray-600 text-base font-normal">Store validation reports and business analytics</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-4 gap-5 mb-8">
    <div class="flex p-3 bg-white border border-gray-200 rounded-lg shadow-sm justify-between">
        <div class="p-2">
            <p class="font-semibold text-gray-900">Low Stock Items</p>
            <p class="mb-4"><?= count($lowStockItems) ?></p>
            <p class="text-sm text-gray-500 mt-2">Need restocking</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-lg mt-1">
            <div class="icon-admin bg-orange-500">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
            </div>
        </div>
    </div>

    <div class="flex p-3 bg-white border border-gray-200 rounded-lg shadow-sm justify-between">
        <div class="p-2">
            <p class="font-semibold text-gray-900">Out of Stock</p>
            <p class="mb-4"><?= count($outOfStockItems) ?></p>
            <p class="text-sm text-gray-500 mt-2">Urgent action needed</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-lg mt-1">
            <div class="icon-admin bg-red-500">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-x-icon lucide-package-x">
                    <path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                    <path d="m7.5 4.27 9 5.15" />
                    <polyline points="3.29 7 12 12 20.71 7" />
                    <line x1="12" x2="12" y1="22" y2="12" />
                    <path d="m17 13 5 5m-5 0 5-5" />
                </svg>
            </div>
        </div>
    </div>

    <div class="flex p-3 bg-white border border-gray-200 rounded-lg shadow-sm justify-between">
        <div class="p-2">
            <p class="font-semibold text-gray-900">Pending Orders</p>
            <p class="mb-4"><?= count($pendingOrders) ?></p>
            <p class="text-sm text-gray-500 mt-2">Awaiting confirmation</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-lg mt-1">
            <div class="icon-admin bg-blue-500">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock">
                    <path d="M12 6v6l4 2" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>
        </div>
    </div>

    <div class="flex p-3 bg-white border border-gray-200 rounded-lg shadow-sm justify-between">
        <div class="p-2">
            <p class="font-semibold text-gray-900">Monthly Revenue</p>
            <p class="mb-4">₱<?= number_format($salesSummary['total_revenue'], 2) ?></p>
            <p class="text-sm text-gray-500 mt-2"><?= $salesSummary['total_orders'] ?> orders</p>
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-lg mt-1">
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
</div>

<!-- Tab Navigation -->
<div class="mb-6 border-b border-gray-200">
    <nav class="flex space-x-8">
        <button onclick="switchTab('inventory')" id="tab-inventory" class="report-tab active py-4 px-1 border-b-2 font-medium text-sm">
            Inventory Validation
        </button>
        <button onclick="switchTab('orders')" id="tab-orders" class="report-tab py-4 px-1 border-b-2 font-medium text-sm">
            Order Reports
        </button>
        <button onclick="switchTab('sales')" id="tab-sales" class="report-tab py-4 px-1 border-b-2 font-medium text-sm">
            Sales Analytics
        </button>
        <button onclick="switchTab('customers')" id="tab-customers" class="report-tab py-4 px-1 border-b-2 font-medium text-sm">
            Customer Insights
        </button>
        <button onclick="switchTab('delivery')" id="tab-delivery" class="report-tab py-4 px-1 border-b-2 font-medium text-sm">
            Delivery Status
        </button>
    </nav>
</div>

<?php include 'tabs/inventory.php'; ?>
<?php include 'tabs/orders.php'; ?>
<?php include 'tabs/sales.php'; ?>
<?php include 'tabs/customers.php'; ?>
<?php include 'tabs/delivery.php'; ?>

<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tabs
        document.querySelectorAll('.report-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');

        // Add active class to selected tab
        document.getElementById('tab-' + tabName).classList.add('active');

        // Update URL with query parameter (except for inventory which is default)
        if (tabName === 'inventory') {
            // For inventory tab, use clean URL without query parameter
            window.history.pushState({tab: tabName}, '', '/admin/reports');
        } else {
            // For other tabs, add query parameter
            window.history.pushState({tab: tabName}, '', '/admin/reports?tab=' + tabName);
        }
    }

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(event) {
        if (event.state && event.state.tab) {
            switchTabWithoutHistory(event.state.tab);
        } else {
            switchTabWithoutHistory('inventory');
        }
    });

    // Switch tab without updating history (for popstate)
    function switchTabWithoutHistory(tabName) {
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.querySelectorAll('.report-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        document.getElementById('content-' + tabName).classList.remove('hidden');
        document.getElementById('tab-' + tabName).classList.add('active');
    }

    // On page load, check for tab parameter in URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        
        if (tab) {
            switchTabWithoutHistory(tab);
        } else {
            // Default to inventory tab
            switchTabWithoutHistory('inventory');
        }
    });
</script>

<?php layout('admin/footer') ?>