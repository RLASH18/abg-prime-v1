<div id="content-delivery" class="tab-content hidden">
    <div class="grid grid-cols-1 gap-6">
        <!-- Delivery Statistics Cards -->
        <div class="grid grid-cols-2 gap-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Deliveries</p>
                        <p class="text-3xl font-bold text-gray-900"><?= $deliveryStats['total'] ?></p>
                    </div>
                    <div class="icon-admin">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                            <path d="M15 18H9" />
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                            <circle cx="17" cy="18" r="2" />
                            <circle cx="7" cy="18" r="2" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Scheduled</p>
                        <p class="text-3xl font-bold text-yellow-600"><?= $deliveryStats['scheduled'] ?></p>
                    </div>
                    <div class="icon-admin bg-yellow-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                            <path d="M16 14v2.2l1.6 1" />
                            <path d="M16 2v4" />
                            <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                            <path d="M3 10h5" />
                            <path d="M8 2v4" />
                            <circle cx="16" cy="16" r="6" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">In Transit</p>
                        <p class="text-3xl font-bold text-blue-600"><?= $deliveryStats['in_transit'] ?></p>
                    </div>
                    <div class="icon-admin bg-blue-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader-icon lucide-loader">
                            <path d="M12 2v4" />
                            <path d="m16.2 7.8 2.9-2.9" />
                            <path d="M18 12h4" />
                            <path d="m16.2 16.2 2.9 2.9" />
                            <path d="M12 18v4" />
                            <path d="m4.9 19.1 2.9-2.9" />
                            <path d="M2 12h4" />
                            <path d="m4.9 4.9 2.9 2.9" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Delivered</p>
                        <p class="text-3xl font-bold text-green-600"><?= $deliveryStats['delivered'] ?></p>
                    </div>
                    <div class="icon-admin bg-green-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                            <path d="m9 11 3 3L22 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Failed</p>
                        <p class="text-3xl font-bold text-red-600"><?= $deliveryStats['failed'] ?></p>
                    </div>
                    <div class="icon-admin bg-red-500">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-x-icon lucide-badge-x">
                            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <line x1="15" x2="9" y1="9" y2="15" />
                            <line x1="9" x2="15" y1="9" y2="15" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delivery Performance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Delivery Performance</h3>
            <div class="grid grid-cols-3 gap-6">
                <div class="border-l-4 border-green-500 pl-4">
                    <p class="text-sm text-gray-600 mb-1">Success Rate</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?= $deliveryStats['total'] > 0 ? number_format(($deliveryStats['delivered'] / $deliveryStats['total']) * 100, 1) : 0 ?>%
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Successfully delivered orders</p>
                </div>
                <div class="border-l-4 border-red-500 pl-4">
                    <p class="text-sm text-gray-600 mb-1">Failure Rate</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?= $deliveryStats['total'] > 0 ? number_format(($deliveryStats['failed'] / $deliveryStats['total']) * 100, 1) : 0 ?>%
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Failed delivery attempts</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-600 mb-1">In Progress</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?= $deliveryStats['scheduled'] + $deliveryStats['in_transit'] ?>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Scheduled + In Transit</p>
                </div>
            </div>
        </div>
    </div>
</div>