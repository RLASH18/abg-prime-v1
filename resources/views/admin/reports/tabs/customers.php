<div id="content-customers" class="tab-content hidden">
    <div class="grid grid-cols-1 gap-6">
        <!-- Customer Statistics Cards -->
        <div class="grid grid-cols-4 gap-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Customers</p>
                        <p><?= $customerStats['total'] ?></p>
                    </div>
                    <div class="icon-admin">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-icon lucide-user-round">
                            <circle cx="12" cy="8" r="5" />
                            <path d="M20 21a8 8 0 0 0-16 0" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Active Customers</p>
                        <p><?= $customerStats['active'] ?></p>
                    </div>
                    <div class="icon-admin bg-green-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-check-icon lucide-user-round-check">
                            <path d="M2 21a8 8 0 0 1 13.292-6" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="m16 19 2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">New Customers</p>
                        <p><?= $customerStats['new'] ?></p>
                    </div>
                    <div class="icon-admin bg-blue-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-plus-icon lucide-user-round-plus">
                            <path d="M2 21a8 8 0 0 1 13.292-6" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M19 16v6" />
                            <path d="M22 19h-6" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Inactive Customers</p>
                        <p><?= $customerStats['inactive'] ?></p>
                    </div>
                    <div class="icon-admin bg-gray-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-x-icon lucide-user-round-x">
                            <path d="M2 21a8 8 0 0 1 11.873-7" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="m17 17 5 5" />
                            <path d="m22 17-5 5" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Insights -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Insights</h3>
            <div class="grid grid-cols-2 gap-6">
                <div class="border-l-4 border-green-500 pl-4">
                    <p class="text-sm text-gray-600 mb-1">Active Customer Rate</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?= $customerStats['total'] > 0 ? number_format(($customerStats['active'] / $customerStats['total']) * 100, 1) : 0 ?>%
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Customers who have placed orders</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-600 mb-1">New Customer Growth</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?= $customerStats['total'] > 0 ? number_format(($customerStats['new'] / $customerStats['total']) * 100, 1) : 0 ?>%
                    </p>
                    <p class="text-xs text-gray-500 mt-1">New registrations in last 30 days</p>
                </div>
            </div>
        </div>
    </div>
</div>