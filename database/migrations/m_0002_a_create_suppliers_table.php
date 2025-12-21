<?php

use app\core\Application;

class m_0002_a_create_suppliers_table
{
    public function up()
    {
        $SQL = "CREATE TABLE suppliers (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    supplier_name VARCHAR(255) NOT NULL,
                    contact_person VARCHAR(255),
                    email VARCHAR(255),
                    phone VARCHAR(50),
                    address TEXT,
                    status ENUM('active', 'inactive') DEFAULT 'active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=INNODB;";

        $db = Application::$app->db;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $SQL = "DROP TABLE suppliers;";
        $db = Application::$app->db;
        $db->pdo->exec($SQL);
    }
}
