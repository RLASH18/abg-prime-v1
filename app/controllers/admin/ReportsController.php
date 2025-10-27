<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\core\Request;
use app\models\Billings;
use app\models\Inventory;
use app\models\Orders;
use app\models\OrderItems;
use app\models\User;
use app\models\Delivery;

class ReportsController extends Controller
{
    /**
     * Display the reports dashboard with various validation reports
     */
    public function index()
    {
        // Inventory Validation Reports
        $lowStockItems = $this->getLowStockItems();
        $outOfStockItems = $this->getOutOfStockItems();
        $overstockedItems = $this->getOverstockedItems();
        
        // Order Validation Reports
        $pendingOrders = $this->getPendingOrders();
        $cancelledOrders = $this->getCancelledOrders();
        
        // Sales Reports
        $salesSummary = $this->getSalesSummary();
        $topSellingItems = $this->getTopSellingItems();
        
        // Customer Reports
        $customerStats = $this->getCustomerStats();
        
        // Delivery Reports
        $deliveryStats = $this->getDeliveryStats();

        $data = [
            'title' => 'Reports & Validation',
            'lowStockItems' => $lowStockItems,
            'outOfStockItems' => $outOfStockItems,
            'overstockedItems' => $overstockedItems,
            'pendingOrders' => $pendingOrders,
            'cancelledOrders' => $cancelledOrders,
            'salesSummary' => $salesSummary,
            'topSellingItems' => $topSellingItems,
            'customerStats' => $customerStats,
            'deliveryStats' => $deliveryStats
        ];

        return $this->view('admin/reports/index', $data);
    }

    /**
     * Get items with stock below restock threshold
     */
    private function getLowStockItems()
    {
        $allItems = Inventory::all();
        $lowStock = [];

        foreach ($allItems as $item) {
            if ($item->quantity > 0 && $item->quantity <= $item->restock_threshold) {
                $lowStock[] = [
                    'id' => $item->id,
                    'name' => $item->item_name,
                    'category' => $item->category,
                    'quantity' => $item->quantity,
                    'threshold' => $item->restock_threshold,
                    'supplier' => $item->supplier_name ?? 'N/A'
                ];
            }
        }

        return $lowStock;
    }

    /**
     * Get items that are completely out of stock
     */
    private function getOutOfStockItems()
    {
        $items = Inventory::whereMany(['quantity' => 0]);
        $outOfStock = [];

        foreach ($items as $item) {
            $outOfStock[] = [
                'id' => $item->id,
                'name' => $item->item_name,
                'category' => $item->category,
                'supplier' => $item->supplier_name ?? 'N/A'
            ];
        }

        return $outOfStock;
    }

    /**
     * Get items with excessive stock (3x above restock threshold)
     */
    private function getOverstockedItems()
    {
        $allItems = Inventory::all();
        $overstocked = [];

        foreach ($allItems as $item) {
            if ($item->quantity > ($item->restock_threshold * 3)) {
                $overstocked[] = [
                    'id' => $item->id,
                    'name' => $item->item_name,
                    'category' => $item->category,
                    'quantity' => $item->quantity,
                    'threshold' => $item->restock_threshold,
                    'excess' => $item->quantity - ($item->restock_threshold * 3)
                ];
            }
        }

        return $overstocked;
    }

    /**
     * Get pending orders that need attention
     */
    private function getPendingOrders()
    {
        $orders = Orders::whereMany(['status' => 'pending']);
        $pending = [];

        foreach ($orders as $order) {
            $user = User::find($order->user_id);
            $daysPending = floor((time() - strtotime($order->created_at)) / 86400);
            
            $pending[] = [
                'id' => $order->id,
                'customer' => $user->name ?? 'Unknown',
                'total' => $order->total_amount,
                'days_pending' => $daysPending,
                'created_at' => $order->created_at
            ];
        }

        return $pending;
    }

    /**
     * Get cancelled orders for analysis
     */
    private function getCancelledOrders()
    {
        $orders = Orders::whereMany(['status' => 'cancelled']);
        $cancelled = [];

        foreach ($orders as $order) {
            $user = User::find($order->user_id);
            
            $cancelled[] = [
                'id' => $order->id,
                'customer' => $user->name ?? 'Unknown',
                'total' => $order->total_amount,
                'cancelled_at' => $order->updated_at
            ];
        }

        return array_slice($cancelled, 0, 10); // Last 10 cancelled orders
    }

    /**
     * Get sales summary for current month
     */
    private function getSalesSummary()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        $allOrders = Orders::all();
        $totalOrders = 0;
        $totalRevenue = 0;
        $completedOrders = 0;

        foreach ($allOrders as $order) {
            $orderDate = date('Y-m-d', strtotime($order->created_at));
            if ($orderDate >= $startDate && $orderDate <= $endDate) {
                $totalOrders++;
                $totalRevenue += (float)$order->total_amount;
                if ($order->status === 'delivered') {
                    $completedOrders++;
                }
            }
        }

        return [
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
            'completed_orders' => $completedOrders,
            'completion_rate' => $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0
        ];
    }

    /**
     * Get top 10 selling items
     */
    private function getTopSellingItems()
    {
        $allOrders = Orders::all();
        $itemSales = [];

        foreach ($allOrders as $order) {
            // Load the order items using whereMany
            $orderItems = OrderItems::whereMany(['order_id' => $order->id]);
            
            foreach ($orderItems as $orderItem) {
                $itemId = $orderItem->item_id;
                if (!isset($itemSales[$itemId])) {
                    $item = Inventory::find($itemId);
                    $itemSales[$itemId] = [
                        'id' => $itemId,
                        'name' => $item->item_name ?? 'Unknown',
                        'category' => $item->category ?? 'N/A',
                        'quantity_sold' => 0,
                        'revenue' => 0
                    ];
                }
                $itemSales[$itemId]['quantity_sold'] += (int)$orderItem->quantity;
                // Calculate subtotal since it's not stored in the table
                $subtotal = (float)$orderItem->quantity * (float)$orderItem->unit_price;
                $itemSales[$itemId]['revenue'] += $subtotal;
            }
        }

        // Sort by quantity sold
        usort($itemSales, function($a, $b) {
            return $b['quantity_sold'] - $a['quantity_sold'];
        });

        return array_slice($itemSales, 0, 10);
    }

    /**
     * Get customer statistics
     */
    private function getCustomerStats()
    {
        $totalCustomers = User::countWhere(['role' => 'customer']);
        $activeCustomers = 0;
        $newCustomers = 0;

        $allCustomers = User::whereMany(['role' => 'customer']);
        $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));

        foreach ($allCustomers as $customer) {
            // Check if customer has orders
            $orders = Orders::whereMany(['user_id' => $customer->id]);
            if (count($orders) > 0) {
                $activeCustomers++;
            }

            // Check if customer registered in last 30 days
            if ($customer->created_at >= $thirtyDaysAgo) {
                $newCustomers++;
            }
        }

        return [
            'total' => $totalCustomers,
            'active' => $activeCustomers,
            'new' => $newCustomers,
            'inactive' => $totalCustomers - $activeCustomers
        ];
    }

    /**
     * Get delivery statistics
     */
    private function getDeliveryStats()
    {
        $allDeliveries = Delivery::all();
        $stats = [
            'total' => count($allDeliveries),
            'scheduled' => 0,
            'in_transit' => 0,
            'delivered' => 0,
            'failed' => 0
        ];

        foreach ($allDeliveries as $delivery) {
            if (isset($stats[$delivery->status])) {
                $stats[$delivery->status]++;
            }
        }

        return $stats;
    }
}
