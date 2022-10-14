<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use App\Models\Pengajuan_detail;
use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
        $belum_approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', null)->paginate(10);
        $approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->paginate(10);
        return view('super_admin.index', compact('approve', 'belum_approve'));
    }

    public function barang()
    {
        $barang = Barang::all();
        return view('super_admin.barang', compact('barang'));
    }

    public function detail($id)
    {
        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        $pengajuan = Pengajuan::where('id', $id)->first();
        $barang = Barang::all();
        return view('super_admin.detail', compact('pengajuan_detail', 'pengajuan', 'barang'));
    }

    public function store(Request $request)
    {
        $pengajuan = Pengajuan::where('id', $request->id)->first();
        $pengajuan->level_2 = Auth::user()->id;
        $pengajuan->update();



        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $request->id)->get();
        $user = User::where('role', 'level_3')->get();

        $role = array();
        foreach ($user as $p) {
            $row =  $p->email;
            array_push($role, $row);
        }
        // dd($role);
        $jsonNilai = array();
        foreach ($pengajuan_detail as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }

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

        return back()->with('success', 'Berhasil Approve');
    }
}
