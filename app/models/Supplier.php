<?php

namespace app\models;

use app\core\Model;
use app\models\Inventory;

class Supplier extends Model
{
    public static function tableName(): string
    {
        return 'suppliers';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return [
            'supplier_name',
            'contact_person',
            'email',
            'phone',
            'address',
            'status'
        ];
    }

    /**
     * Get all active suppliers
     */
    public static function getActive(): array
    {
        return self::whereMany(['status' => 'active']);
    }

    /**
     * Get supplier by ID with error handling
     */
    public static function findOrFail(int $id)
    {
        $supplier = self::find($id);
        if (!$supplier) {
            throw new \Exception("Supplier not found");
        }
        return $supplier;
    }

    /**
     * Get inventory items for this supplier
     */
    public function inventoryItems(): array
    {
        return Inventory::whereMany(['supplier_id' => $this->id]);
    }

    /**
     * Count inventory items for this supplier
     */
    public function inventoryCount(): int
    {
        return Inventory::countWhere(['supplier_id' => $this->id]);
    }
}
