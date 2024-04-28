<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Jadwal;
use App\Models\Layanan;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Cart::with(['user', 'layanan'])->where('id_user', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('id_layanan', function ($item) {
                    return $item->layanan->nama_layanan ?? '-';
                })
                ->editColumn('total_harga', function ($item) {
                    return 'Rp. ' . number_format($item->total_harga, 0, ',', '.');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteCart(
                            ' . $item->id_keranjang . '
                        )">
                            Hapus
                        </a>
                    ';
                })
                ->rawColumns(['alamat', 'thumbnail', 'action'])
                ->make(true);
        }

        $kodeUnik = mt_rand(100, 999);
        $harga = Cart::where('id_user', Auth::user()->id)->sum('total_harga');


        $totalPembayaran = $harga + $kodeUnik;
        $countCart = Cart::where('id_user', Auth::user()->id)->count();

        // $listTanggalBooking = Transaction::pluck('tanggal_awal_booking', 'tanggal_akhir_booking');

        // $listTanggal = [];

        // foreach ($listTanggalBooking as $key => $value) {
        //     $listTanggal[] = [
        //         'start' => $key,
        //         'end' => $value
        //     ];
        // }

        $listTanggalBooking = Transaction::pluck('tanggal_awal_booking', 'tanggal_akhir_booking')->toArray();

        return view('cart', compact('kodeUnik', 'harga', 'totalPembayaran', 'countCart', 'listTanggalBooking'));
    }

    public function addToCart(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $data = Cart::create([
            'id_user' => Auth::user()->id,
            'id_layanan' => $id,
            'total_harga' => $layanan->harga,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Layanan berhasil ditambahkan ke keranjang');
            return redirect()->route('cart');
        } else {
            Alert::error('Gagal', 'Layanan gagal ditambahkan ke keranjang');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $cart = Cart::findOrFail($request->id);
        $cart->delete();

        if ($cart) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan berhasil dihapus dari keranjang'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan gagal dihapus dari keranjang'
            ]);
        }
    }

    public function checkTanggal(Request $request)
    {
        $twoDaysBefore = date('Y-m-d', strtotime('-2 days', strtotime($request->tanggal_acara)));
        $twoDaysAfter = date('Y-m-d', strtotime('+2 days', strtotime($request->tanggal_acara)));

        $query = Transaction::select('tanggal_acara')->whereBetween('tanggal_acara', [$twoDaysBefore, $twoDaysAfter])->first();


        if ($query) {
            return response()->json([
                'status' => false,
                'message' => 'Tanggal acara sudah dibooking oleh customer lain, silahkan pilih tanggal lain'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Tanggal acara tersedia'
            ]);
        }

        return response()->json($query);
    }

    // public function getTanggalBooking()
    // {
    //     // Ambil semua transaksi
    //     $transactions = Transaction::all();

    //     $listDateBooked = [];

    //     foreach ($transactions as $transaction) {
    //         // Menggunakan Carbon untuk mengiterasi dari tanggal_awal_booking hingga tanggal_akhir_booking
    //         $period = Carbon::parse($transaction->tanggal_awal_booking)->daysUntil($transaction->tanggal_akhir_booking);

    //         // Tambahkan setiap tanggal dalam periode ke array
    //         foreach ($period as $date) {
    //             $listDateBooked[] = $date->format('Y-m-d');
    //         }
    //     }

    //     // Menghapus duplikat tanggal dan gunakan array_values untuk memastikan array tetap berformat array setelah di-JSON encode
    //     $listDateBooked = array_values(array_unique($listDateBooked));

    //     // Mengambil semua tanggal yang sudah dibooking oleh user
    //     $cart = Cart::where('id_user', Auth::user()->id)->pluck('id_layanan')->toArray();
    //     $yangPunyaLayanan = Layanan::where('id_layanan', $cart)->pluck('id_user')->toArray();
    //     $jadwalTutup = Jadwal::where('id_user', $yangPunyaLayanan)->pluck('tanggal')->toArray();

    //     return response()->json([
    //         'booked' => $listDateBooked,
    //         'jadwalTutup' => $jadwalTutup
    //     ]);
    // }

    // public function getTanggalBooking()
    // {
    //     // Mengambil tanggal booking dari transaksi
    //     $transactions = Transaction::select('tanggal_awal_booking', 'tanggal_akhir_booking')->get();

    //     $listDateBooked = [];

    //     foreach ($transactions as $transaction) {
    //         $period = Carbon::parse($transaction->tanggal_awal_booking)
    //             ->daysUntil($transaction->tanggal_akhir_booking);
    //         foreach ($period as $date) {
    //             $listDateBooked[] = $date->format('Y-m-d');
    //         }
    //     }

    //     $listDateBooked = array_values(array_unique($listDateBooked));

    //     // Mengambil tanggal tutup berdasarkan jadwal yang terkait dengan user
    //     $cart = Cart::where('id_user', Auth::user()->id)->pluck('id_layanan')->toArray();
    //     $yangPunyaLayanan = Layanan::whereIn('id_layanan', $cart)->pluck('id_user')->toArray();
    //     $jadwalTutup = Jadwal::whereIn('id_user', $yangPunyaLayanan)->pluck('tanggal')->toArray();

    //     // Gabungkan tanggal yang dibook dengan jadwal tutup
    //     $datesUnavailable = array_merge($listDateBooked, $jadwalTutup);
    //     $datesUnavailable = array_values(array_unique($datesUnavailable));

    //     return response()->json([
    //         'unavailableDates' => $datesUnavailable
    //     ]);
    // }

    public function getTanggalBooking()
    {
        // Inisialisasi array untuk menyimpan tanggal yang tidak tersedia
        $unavailableDates = [];

        // Ambil semua transaksi dan tambahkan ke array tanggal yang tidak tersedia
        $transactions = Transaction::select('tanggal_awal_booking', 'tanggal_akhir_booking')->get();
        foreach ($transactions as $transaction) {
            $period = Carbon::parse($transaction->tanggal_awal_booking)->daysUntil($transaction->tanggal_akhir_booking)->toArray();
            foreach ($period as $date) {
                $unavailableDates[] = $date->format('Y-m-d');
            }
        }

        // Ambil semua jadwal tutup dan tambahkan ke array tanggal yang tidak tersedia
        $jadwalTutup = Jadwal::select('tanggal_awal_tutup', 'tanggal_akhir_tutup')->get();
        foreach ($jadwalTutup as $jadwal) {
            $periodTutup = Carbon::parse($jadwal->tanggal_awal_tutup)->daysUntil($jadwal->tanggal_akhir_tutup)->toArray();
            foreach ($periodTutup as $dateTutup) {
                $unavailableDates[] = $dateTutup->format('Y-m-d');
            }
        }

        // Hilangkan duplikat tanggal dan reset index array
        $unavailableDates = array_values(array_unique($unavailableDates));

        // Kirim kembali tanggal yang tidak tersedia sebagai respons JSON
        return response()->json([
            'unavailableDates' => $unavailableDates
        ]);
    }

}
