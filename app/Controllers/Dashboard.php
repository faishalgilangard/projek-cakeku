<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Dashboard extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transactionDetail;

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transactionDetail = new TransactionDetailModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        // Statistik penjualan bulanan dan penghasilan
        $monthlySales = $this->transaction
            ->select("MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total_harga) as total_income")
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->findAll();

        $totalIncome = $this->transaction->selectSum('total_harga')->first()['total_harga'] ?? 0;
        $totalOrders = $this->transaction->countAllResults();
        $transactions = $this->transaction->orderBy('created_at', 'DESC')->findAll();

        // Ambil detail produk untuk setiap transaksi
        $productsPerOrder = [];
        foreach ($transactions as $trx) {
            $details = $this->transactionDetail
                ->select('transaction_detail.*, product.nama, product.harga, product.foto')
                ->join('product', 'transaction_detail.product_id = product.id')
                ->where('transaction_id', $trx['id'])
                ->findAll();
            $productsPerOrder[$trx['id']] = $details;
        }

        return view('dashboard-toko/index', [
            'transactions' => $transactions,
            'monthlySales' => $monthlySales,
            'totalIncome' => $totalIncome,
            'totalOrders' => $totalOrders,
            'product' => $productsPerOrder // untuk modal struk
        ]);
    }

    public function cetak()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $id = $this->request->getGet('id');
        $trx = $this->transaction->find($id);

        if (!$trx) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan.');
        }

        $details = $this->transactionDetail
            ->select('transaction_detail.*, product.nama, product.harga, product.foto')
            ->join('product', 'transaction_detail.product_id = product.id')
            ->where('transaction_id', $id)
            ->findAll();

        return view('dashboard-toko/cetak_struk', [
            'trx' => $trx,
            'details' => $details
        ]);
    }


    public function updateStatus($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $status = (int) $this->request->getPost('status');

        if (!in_array($status, [0, 1, 2])) {
            return redirect()->back()->with('error', 'Status tidak valid!');
        }

        $this->transaction->update($id, ['status' => $status]);
        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $this->transaction->delete($id);
        return redirect()->back();
    }
}
