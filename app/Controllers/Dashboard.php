<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;

class Dashboard extends BaseController
{
    protected $product;
    protected $transaction;

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
        $transactions = $this->transaction->orderBy('created_at', 'DESC')->findAll();
        // Debug: cek isi data
        // dd($transactions);
        return view('dashboard-toko/index', ['transactions' => $transactions]);
    }

    public function cetak()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
        $transactions = $this->transaction->orderBy('created_at', 'DESC')->findAll();
        return view('dashboard-toko/cetak', ['transactions' => $transactions]);
    }
}
