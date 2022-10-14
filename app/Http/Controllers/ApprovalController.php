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

class ApprovalController extends Controller
{

    public function tes(Request $request)
    {
        if ($request->expectsJson()) {
            $data = Pengajuan::where('level_1', null)->get();
            return response()->json(['tes' => $data->count()], 200);
        }
        return response()->json(['gagal' => 'gaagal']);
    }
    public function index()
    {
        $belum_approve = Pengajuan::with('user_pengajuan')->where('level_3', null)->where('user_id_pengajuan', Auth::user()->id)->get();
        $approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->where('level_3', '!=', null)->where('user_id_pengajuan', Auth::user()->id)->get();
        return view('approval.index', compact('belum_approve', 'approve'));
    }

    public function data_admin_barang_belum_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
                   
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:red">Masih Diperiksa</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/approve_admin_detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="/kerja/pengajuan_aplikasi_versi_7/pengajuan_detail/delete_pengajuan/' . $emp->id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_admin_barang_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:chartreuse">Approve</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/approve_admin_detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_level_2_barang_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:chartreuse">Approve</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/super_admin_detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_level_2_barang_belum_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
                   
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:red">Masih Diperiksa</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/super_admin_detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="/kerja/pengajuan_aplikasi_versi_7/pengajuan_detail/delete_pengajuan/' . $emp->id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_level_3_barang_belum_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->where('level_3', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
                   
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:red">Masih Diperiksa</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/super_super_admin_detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="/kerja/pengajuan_aplikasi_versi_7/pengajuan_detail/delete_pengajuan/' . $emp->id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_level_3_barang_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->where('level_3', '!=', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:chartreuse">Approve</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/super_super_admin_detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_user_barang_belum_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_3', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
                   
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $alamat = "'.{{ route('approval_detail', $emp->id) }}.'";
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:red">Masih Diperiksa</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="/kerja/pengajuan_aplikasi_versi_7/pengajuan_detail/delete_pengajuan/' . $emp->id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function data_user_barang_approve()
    {

        $emps = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->where('level_3', '!=', null)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
               <td>No</td>
               <td>Nama Pengajuan</td>
                <td>Tanggal Pengajuan</td>
                <td>Tanggal Penginputan</td>
                <td>Total Biaya</td>
                <td>Approval</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->user_pengajuan->name . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . \Carbon\Carbon::parse($emp->created_at)->isoformat('D MMMM Y') . ' - ' . \Carbon\Carbon::parse($emp->created_at)->format('H:i') . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->total_biaya, 2, ',', '.') . '</td>
                  <td><p style="color:chartreuse">Approve</p> </td>
                <td>
                <a href="/kerja/pengajuan_aplikasi_versi_7/approval/detail/' . $emp->id . '" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function detail($id)
    {
        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        $pengajuan = Pengajuan::where('id', $id)->first();
        $barang = Barang::all();
        return view('approval.detail', compact('pengajuan_detail', 'pengajuan', 'barang'));
    }

    public function edit($pengajuan_detail, $pengajuan)
    {
        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $pengajuan)->Find($pengajuan_detail);
        return view('approval.edit', compact('pengajuan_detail'));
    }

    public function update(Request $request)
    {
        $update = Pengajuan_detail::where('id', $request->id)->first();
        $update->jumlah_barang = $request->jumlah_barang;
        $update->save();



        $pengajuan_detail = Pengajuan_detail::where('pengajuan_id', $request->pengajuan_id)->get();
        // return response()->json([
        //     'data' => $pengajuan_detail
        // ]);
        $jsonNilai = array();
        foreach ($pengajuan_detail as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }
        // dd($jsonNilai);

        Pengajuan::where('id', $request->pengajuan_id)->update([
            'total_biaya' => array_sum($jsonNilai),
        ]);
        return back()->with('success', 'Berhasil Mengubah Data');
    }

    public function admin()
    {

        $belum_approve = Pengajuan::with('user_pengajuan')->where('level_1', null)->get();
        $approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->get();
        return view('admin.admin_approval', compact('belum_approve', 'approve'));
    }

    // public function notiv()
    // {

    //     $belum_approve = Pengajuan::with('user_pengajuan')->where('level_1', null)->get();
    //     $approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->get();
    //     return view('admin.admin_approval_notiv', compact('belum_approve', 'approve'));
    // }

    // public function notiv_user()
    // {

    //     $approve = Pengajuan::where('user_id_pengajuan', Auth::user()->id)->where('level_1', '!=', null)->where('level_2', '!=', null)->where('level_3', '!=', null)->get();
    //     $belum_approve = Pengajuan::where('user_id_pengajuan', Auth::user()->id)->where('level_3', null)->get();

    //     return view('approval.notiv', compact('belum_approve', 'approve'));
    // }

    // public function notiv2()
    // {

    //     $belum_approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', null)->get();
    //     $approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->get();
    //     return view('super_admin.notiv', compact('belum_approve', 'approve'));
    // }

    // public function notiv3()
    // {

    //     $belum_approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=',  null)->where('level_3', null)->get();
    //     $approve = Pengajuan::with('user_pengajuan')->where('level_1', '!=', null)->where('level_2', '!=', null)->where('level_3', '!=', null)->get();
    //     return view('super_super_admin.notiv', compact('belum_approve', 'approve'));
    // }

    public function approve_admin(Request $request)
    {
        $pengajuan = Pengajuan::where('id', $request->id)->first();
        $pengajuan->level_1 = Auth::user()->id;
        $pengajuan->update();

        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $request->id)->get();
        $user = User::where('role', 'level_2')->get();
        // $pengajuan = Pengajuan::where('id', $request->id)->where('')->get();
        // $jsonNilai = array();
        // $nama = array();
        // foreach ($pengajuan_detail as $p) {
        //     $nama_barang =  $p->barang->nama_barang;
        //     array_push($nama, $nama_barang);
        // }
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

    public function approve_admin_detail($id)
    {
        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        $pengajuan = Pengajuan::where('id', $id)->first();
        $barang = Barang::all();

        return view('admin.admin_approval_detail', compact('pengajuan_detail', 'pengajuan', 'barang'));
    }

    public function editaprrove(Request $request)
    {
        $id = $request->id;
        $emp = Pengajuan_detail::where('id', $id)->first();
        return response()->json($emp);
    }

    public function updateapprove(Request $request)
    {

        // dd(request());
        $empData = [
            'jumlah_barang' => $request->jumlah_barang,
        ];
        $emp = Pengajuan_detail::where('id', $request->id)->update($empData);

        $pengajuan_detail = Pengajuan_detail::where('pengajuan_id', $request->pengajuan_id)->get();

        $jsonNilai = array();
        foreach ($pengajuan_detail as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }
        // $emp->update($empData);
        Pengajuan::where('id', $request->pengajuan_id)->update([
            'total_biaya' => array_sum($jsonNilai),
        ]);

        // dd($emp);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function total($id)
    {
        $pengajuan_detail = Pengajuan_detail::where('pengajuan_id', $id)->get();

        $jsonNilai = array();
        foreach ($pengajuan_detail as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }

        return response()->json([
            // array_sum($jsonNilai)
            'data' => array_sum($jsonNilai),
            'tes' => 44
        ]);
    }

    public function delete($pengajuan, $pengajuan_detail,  Request $request)
    {
        // dd($request);

        $pengajuan_detail = Pengajuan_detail::where('id', $pengajuan_detail)->delete();

        // $kondisi = Pengajuan_detail::where('id', $pengajuan_detail)->where('pengajuan_id', $pengajuan)->first();

        $pengajuan_detail = Pengajuan_detail::where('pengajuan_id', $pengajuan)->get();

        $jsonNilai = array();
        foreach ($pengajuan_detail as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }

        $total = Pengajuan::where('id', $pengajuan)->update([
            'total_biaya' => array_sum($jsonNilai),
        ]);
        // dd($kondisi);
        return back()->with('success', 'Data Berhasil Di Hapus');
    }

    public function approve_admin_edit($pengajuan_detail, $pengajuan)
    {
        $pengajuan_detail = Pengajuan_detail::with('barang')->where('pengajuan_id', $pengajuan)->Find($pengajuan_detail);
        return view('approval.admin_approval_edit', compact('pengajuan_detail'));
    }

    public function approve_admin_update(Request $request)
    {
        $update = Pengajuan_detail::where('id', $request->id)->first();
        $update->jumlah_barang = $request->jumlah_barang;
        $update->save();



        $pengajuan_detail = Pengajuan_detail::where('pengajuan_id', $request->pengajuan_id)->get();
        // return response()->json([
        //     'data' => $pengajuan_detail
        // ]);
        $jsonNilai = array();
        foreach ($pengajuan_detail as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }
        // dd($jsonNilai);

        $total = Pengajuan::where('id', $request->pengajuan_id)->update([
            'total_biaya' => array_sum($jsonNilai),
        ]);
        return back()->with('success', 'Berhasil Mengubah Data');
    }

    public function delete_pengajuan($id)
    {

        $pengajuan = Pengajuan_detail::where('pengajuan_id', $id)->get();
        foreach ($pengajuan as $p) {
            Pengajuan_detail::Find($p->id)->delete();
            // array_push($id_delete, $row);
        }
        // dd($id_delete);
        // Pengajuan_detail::where('id', $id_delete)->get()->delete();
        Pengajuan::Find($id)->delete();
        return back()->with('success', 'Berhasil Menghapus Data');
    }

    public function delete_pengajuan_detail(Request $request)
    {
        dd($request);
        $id = $request->id;
        // $pengajuan_id = $request->pengajuan_id;
        // $emp = Pengajuan_detail::find($id);
        // Pengajuan_detail::destroy($id);
        // $kondisi =  Pengajuan_detail::where('pengajuan_id', )
        $pengajuan_detail = Pengajuan_detail::Find($id)->delete();

        $pengajuan_detaill = Pengajuan_detail::where('id', $id)->first();

        $jsonNilai = array();
        foreach ($pengajuan_detaill as $p) {
            $row =  $p->jumlah_barang * $p->harga_satuan;
            array_push($jsonNilai, $row);
        }
        // dd($jsonNilai);

        Pengajuan::where('id', $pengajuan_detaill->pengajuan_id)->update([
            'total_biaya' => array_sum($jsonNilai),
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function all($id)
    {

        $emps = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        // $csrf = @csrf;
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Spesifikasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Satuan Barang</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->barang->nama_barang . '</td>
                <td>' . $emp->barang->spesifikasi . '</td>
                <td>' . $emp->jumlah_barang .
                    '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->harga_satuan, 2, ',', '.') .
                    '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="btn btn-primary mx-1 editIcon" data-toggle="modal" data-target="#pengajuan_detail"><i class="fa-solid fa-pen"></i></a>
                  <a href="/kerja/pengajuan_aplikasi_versi_7/pengajuan_detail/delete/' . $emp->pengajuan_id . '/' . $emp->id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function all_kondisi_admin($id)
    {

        $emps = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        // $csrf = @csrf;
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Spesifikasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Satuan Barang</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->barang->nama_barang . '</td>
                <td>' . $emp->barang->spesifikasi . '</td>
                <td>' . $emp->jumlah_barang .
                    '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->harga_satuan, 2, ',', '.') .
                    '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function all_2($id)
    {

        $emps = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Spesifikasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Satuan Barang</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->barang->nama_barang . '</td>
                <td>' . $emp->barang->spesifikasi . '</td>
                <td>' . $emp->jumlah_barang . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->harga_satuan, 2, ',', '.') .
                    '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="btn btn-primary mx-1 editIcon" data-toggle="modal" data-target="#pengajuan_detail"><i class="fa-solid fa-pen"></i></a>
                  
                  <a href="/kerja/pengajuan_aplikasi_versi_7/pengajuan_detail/delete/' . $emp->pengajuan_id . '/' . $emp->id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function all_kondisi($id)
    {
        $emps = Pengajuan_detail::with('barang')->where('pengajuan_id', $id)->get();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
                <th >No</th>
                <th>Nama Barang</th>
                <th>Spesifikasi Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Satuan Barang</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->barang->nama_barang . '</td>
                <td>' . $emp->barang->spesifikasi . '</td>
                <td>' . $emp->jumlah_barang . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->harga_satuan, 2, ',', '.') . '</td>
              </tr>';
            }
            $output .= '<tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
}
