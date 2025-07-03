<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ProductModel;

class LaporanController extends BaseController
{
    protected $transaction;
    protected $transactionDetail;
    protected $product;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
        $this->transactionDetail = new TransactionDetailModel();
        $this->product = new ProductModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
        // Tampilkan halaman laporan (opsional: filter tanggal, dsb)
        return view('laporan/index');
    }

    public function cetak()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
        $transactions = $this->transaction->orderBy('created_at', 'DESC')->findAll();
        $productsPerOrder = [];
        foreach ($transactions as $trx) {
            $details = $this->transactionDetail
                ->select('transaction_detail.*, product.nama, product.harga, product.foto')
                ->join('product', 'transaction_detail.product_id = product.id')
                ->where('transaction_id', $trx['id'])
                ->findAll();
            $productsPerOrder[$trx['id']] = $details;
        }
        return view('laporan/cetak', [
            'transactions' => $transactions,
            'product' => $productsPerOrder
        ]);
    }
}
