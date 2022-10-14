<?php

namespace App\Http\Controllers;

use App\Events\Notif;
use App\Models\Barang;
use App\Models\keranjang;
use App\Models\Pengajuan;
use App\Models\Pengajuan_detail;
use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class Keranjangontroller extends Controller
{
    public function index()
    {
        $keranjang = keranjang::where('user_id', Auth::user()->id)->get();
        $barang = Barang::all();
        return view('keranjang.index', compact('keranjang', 'barang'));
    }

    public function store(Request $request)
    {
        $databarang = Barang::where('id', $request->barang_id)->first();

        $keranjang = keranjang::where('user_id', Auth::user()->id)->where('barang_id', $request->barang_id)->first();
        // dd($keranjang->count());
        if ($request->barang_id) {
            if (empty($keranjang)) {
                $create = [
                    'barang_id' => $databarang->id,
                    'jumlah' => $request->jumlah,
                    'harga_satuan' => $databarang->harga_barang,
                    'user_id' => Auth::user()->id
                ];

                Keranjang::create($create);
                return back()->with('success', 'Berhasil Menambahkan Data');
            }
        }

        if (empty($request->barang_id)) {

            return back()->with('error', 'Anda Belum Memilih Barang');
        }

        return back()->with('error', 'Data Sudah Ada');
    }

    public function store_approve(Request $request)
    {
        // dd($request);
        $barang = Barang::where('id', $request->barang_id)->first();
        $keranjang = Pengajuan_detail::where('pengajuan_id', $request->pengajuan_id)->where('barang_id', $request->barang_id)->first();

        if ($request->barang_id) {
        if (empty($keranjang)) {
            $create = [
                'pengajuan_id' => $request->pengajuan_id,
                'barang_id' => $barang->id,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_satuan' => $barang->harga_barang,
            ];

            Pengajuan_detail::create($create);

            $pengajuan_detail = Pengajuan_detail::where('pengajuan_id', $request->pengajuan_id)->get();

            $jsonNilai = array();
            foreach ($pengajuan_detail as $p) {
                $row =  $p->jumlah_barang * $p->harga_satuan;
                array_push($jsonNilai, $row);
            }

            Pengajuan::where('id', $request->pengajuan_id)->update([
                'total_biaya' => array_sum($jsonNilai),
            ]);


            return back()->with('success', 'Berhasil Menambahkan Data');
        }
        }
        if (empty($request->barang_id)) {

            return back()->with('error', 'Anda Belum Memilih Barang');
        }



        return back()->with('error', 'Data Sudah Ada !!!');
    }

    public function detail()
    {
        $keranjang = keranjang::with('barang')->where('user_id', Auth::user()->id)->get();
        return view('keranjang.detail' , compact('keranjang'));
    }

    public function storePengajuan(Request $request)
    {

    // foreach($keranjang as $p){
        $create = [
            'tanggal' => \Carbon\Carbon::now()->isoformat('D MMMM Y'),
            'user_id_pengajuan' => Auth::user()->id,
        ];

        $pengajuan = Pengajuan::create($create);

        $keranjang = keranjang::where('user_id', Auth::user()->id)->get();


        if ($keranjang->count() > 0) {
            $jsonNilai = array();
            foreach ($keranjang as $p) {
                $row =  $p->harga_satuan * $p->jumlah;
                array_push($jsonNilai, $row);
                $detail = [
                    'pengajuan_id' => $pengajuan->id,
                    'barang_id' => $p->barang_id,
                    'jumlah_barang' => $p->jumlah,
                    'harga_satuan' => $p->harga_satuan,
                ];

                Pengajuan_detail::create($detail);
            }
            $pu = Pengajuan::where('id', $pengajuan->id)->update([
                'total_biaya' => array_sum($jsonNilai),
            ]);

            $user = User::where('role', 'level_1')->get();

            $role = array();
            foreach ($user as $p) {
                $row =  $p->email;
                array_push($role, $row);
            }
            // dd($role);
            $jsonNilai = array();
            foreach ($keranjang as $p) {
                $row =  $p->jumlah * $p->harga_satuan;
                array_push($jsonNilai, $row);
            }


            $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $pengajuan->id)->get();



            $total = array_sum($jsonNilai);
            $message = view('email', compact('pengajuan_detail', 'total'))->render();

            try {
                foreach ($user as $p) {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'mail.ourproduct.id';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'tester@ourproduct.id';
                    $mail->Password = 'j@x@gptu3@Dg';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom("anandadimmas@anandadimmas.my.id", "Data Pengajuan");
                    $mail->addAddress($p->email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Data Pengajuan';
                    $mail->Body    = $message;
                    $mail->send();
                }
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
            
            foreach ($keranjang as $p) {
                keranjang::Find($p->id)->delete();
            }

            Notif::dispatch();
            return back();
        }
        return back()->with('error', 'Anda Belum Menambahkan Item');
       



        // $options = array(
        //     'cluster' => env('PUSHER_APP_CLUSTER'),
        //     'encrypted' => true
        // );
        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );
        // $pe = Pengajuan::all();
        // $data['message'] = $pe;
        // $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);


    }

    public function total()
    {
        $keranjang = keranjang::where('user_id', Auth::user()->id)->get();

        $jsonNilai = array();
        foreach ($keranjang as $p) {
            $row =  $p->harga_satuan * $p->jumlah;
            array_push($jsonNilai, $row);
        }

        return response()->json([
            // array_sum($jsonNilai)
            'data' => array_sum($jsonNilai),
        ]);
    }


    public function delete($id)
    {
        $keranjang = keranjang::Find($id)->delete();
        return back()->with('success', 'Berhasil Menghapus Data');
    }
}
