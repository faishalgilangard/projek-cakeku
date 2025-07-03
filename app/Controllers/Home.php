<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['featured_products'] = $productModel->findAll(6); // ambil 6 produk terbaru/unggulan

        // Data statistik bisnis (contoh)
        $data['stats'] = [
            'total_orders' => 128,
            'monthly_sales' => 'Rp 12.500.000',
            'popular_product' => 'Kue Brownis'
        ];

        return view('home', $data);
    }
}
