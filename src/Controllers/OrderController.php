<?php

namespace Controllers;

use Models\Order;
use Models\OrderDetails;

class OrderController {
    private $orderModel;
    private $orderDetailsModel;

    public function __construct() {
        $this->orderModel = new Order();
        $this->orderDetailsModel = new OrderDetails();
    }

    // Handle order list view
    public function handleRequest() {
        $orders = $this->orderModel->getAll();
        require_once '../src/Views/orders.php';
    }

    // View details of an order
    public function viewDetails($id) {
        $order = $this->orderModel->getById($id);
        $orderDetails = $this->orderDetailsModel->getByOrderId($id);
        require_once '../src/Views/order_details.php';
    }

    // Update order status
    public function updateStatus($id, $status) {
        if ($this->orderModel->update($id, $status)) {
            header('Location: /projet-commerce-nba/public/orders');
            exit;
        } else {
            echo "Erreur lors de la mise à jour de la commande.";
        }
    }

    public function calculateTotalSales($user_id = null, $start_date = null, $end_date = null) {
        $sales = $this->orderModel->calculateTotalSales($user_id, $start_date, $end_date);
        $users = $this->userModel->getAll(); // Si vous avez un modèle User
        require_once '../src/Views/orders.php';
    }    

    public function createOrder($user_id, $products) {
        $total = 0;
        $details = [];
        foreach ($products as $product_id => $product) {
            if (!empty($product['selected'])) {
                $quantity = intval($product['quantity']);
                $productData = $this->productModel->getById($product_id);
                $total += $productData['price'] * $quantity;
                $details[] = [
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'price' => $productData['price']
                ];
            }
        }
    
        $order_id = $this->orderModel->create($user_id, $total);
    
        foreach ($details as $detail) {
            $this->orderDetailsModel->create($order_id, $detail['product_id'], $detail['quantity'], $detail['price']);
        }
    
        header('Location: /projet-commerce-nba/public/orders');
        exit;
    }    

    public function editOrder($id) {
        $order = $this->orderModel->getById($id);
        require_once '../src/Views/edit_order.php';
    }
    
    public function updateOrder($id, $status) {
        $this->orderModel->update($id, $status);
        header('Location: /projet-commerce-nba/public/orders');
        exit;
    }
    
    public function deleteOrder($id) {
        $this->orderModel->delete($id);
        header('Location: /projet-commerce-nba/public/orders');
        exit;
    }    
}
