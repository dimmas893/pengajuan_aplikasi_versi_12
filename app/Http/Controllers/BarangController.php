<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::paginate(10);
        return view('barang.index', compact('barang'));
    }

    public function store(Request $request)
    {
        $create = [
            'nama_barang' => $request->nama_barang,
            'spesifikasi' => $request->spesifikasi,
            'harga_barang' => $request->harga_barang,
        ];

        Barang::create($create);
        return back()->with('success', 'Berhasil Menambah Data');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = barang::where('id', $id)->first();
        return response()->json($emp);
    }

    public function update(Request $request)
    {
        $empData = [
            'nama_barang' => $request->nama_barang,
            'spesifikasi' => $request->spesifikasi,
            'harga_barang' => $request->harga_barang,
        ];
        $emp = Barang::where('id', $request->id)->update($empData);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Barang::find($id);
        Barang::destroy($id);
    }

    public function barang_json()
    {

        $emps = Barang::all();
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
            '<table class="table" table-striped table-sm text-center align-middle width="100%" cellspacing="0">
             <thead>
              <tr>
              <th>No</th>
                <th>Nama Barang</th>
                <th>Spesifikasi Barang</th>
                <th>Harga Barang</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->nama_barang . '</td>
                <td>' . $emp->spesifikasi . '</td>
                <td>' . 'Rp' . '  ' . number_format($emp->harga_barang, 2, ',', '.') . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="btn btn-primary mx-1 editIcon" data-toggle="modal" data-target="#barang"><i class="fa-solid fa-pen"></i></a>

                  
                  <a href="#" id="' . $emp->id . '" class="btn btn-danger mx-1 deleteIcon"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
}
