<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KategoriKegiatan;
use App\Models\Neraca;
use App\Models\KategoriNeraca;
use App\Models\NeracaChild;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Helpers\Helper;

class NeracaController extends Controller
{

    protected $user;
    protected $neraca;
    protected $neracaChild;
    protected $nL;
    protected $nK;
    protected $helper;
    public function __construct()
    {
        $this->user = new User();
        $this->neraca = new Neraca();
        $this->neracaChild = new NeracaChild();
        $this->nL = new KategoriNeraca();
        $this->nK = new KategoriKegiatan();
        $this->helper = new Helper();
    }
    // =============================Home ===============================================
    public function home()
    {
        $neracas = $this->neraca->all();

        return view("/index", ["neracas" => $neracas]);
    }
    public function dataTahunHome(Request $request)
    {
        return view("/index", ["neracas" => $this->neraca->whereYear('tanggal_mulai', $request->tahun)->get()]);
    }
    // =============================Neraca Produksi Handler=============================
    // go to neraca produksi page
    public function goToNProduksi()
    {
        $kategori = $this->nK->all();
        $neraca = $this->neraca->all();
        return view("pages/neraca_produksi/index", compact('kategori', 'neraca'));
    }
    public function NProduksiEdit($id)
    {
        return redirect('/neracaProduksi')->with('idData', $id);
    }
    public function NProduksiAdd(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'jenis_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'kegiatan' => 'required',
            'total_sampel' => 'required',
            'target_sampel' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'keterangan' => 'required',
        ]);
        $parrent = [
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'kategori_neraca_id' => strval($this->helper->neracalist($request->nL)),
            'kategori_id' => $request->kategori_kegiatan,
            'kegiatan' => $request->kegiatan,
            'total_sample' => $request->total_sampel != null ? $request->total_sampel : 0,
            'target_sample' => $request->target_sampel,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'keterangan' => $request->keterangan,
        ];
        $this->neraca->create($parrent);
        $child = [];
        if ($request->child_kategori_kegiatan != null) {
            $counter = 0;
            foreach ($request->child_kategori_kegiatan as $data) {
                $this->neracaChild->create([
                    "parent_id" => strval(count($this->neraca->all())),
                    "kategori_id" => $request->child_kategori_kegiatan[$counter],
                    "start" => $request->start[$counter],
                    "end" => $request->end[$counter]
                ]);
                $counter++;
            }
        }
        // dd($child);
        return redirect('neracaProduksi')->with(['success' => ['Data Berhasil Ditambah']]);
    }
    public function NProduksiUpdate(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'jenis_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'keterangan' => 'required',
        ]);
        // dd($request);
        $parrent =  $this->neraca->find($request->id);
        // dd($parrent);
        $parrent->jenis_kegiatan = $request->jenis_kegiatan;
        $parrent->kategori_id = $request->kategori_kegiatan;
        $parrent->kegiatan = $request->kegiatan;
        $parrent->total_sample = $request->total_sampel != null ? $request->total_sampel : 0;
        $parrent->keterangan = $request->keterangan;
        $parrent->tanggal_mulai = $request->tanggal_mulai;
        $parrent->tanggal_berakhir = $request->tanggal_berakhir;
        $parrent->save();
        if ($request->child_kategori_kegiatan != null) {
            $child = $this->neracaChild->where('parent_id', $request->id)->get();
            $counter = 0;
            foreach ($child as $item) {
                $item->kategori_id = $request->child_kategori_kegiatan[$counter];
                $item->start = $request->start[$counter];
                $item->end = $request->end[$counter];
                $item->save();
                $counter++;
            };
        }
        return redirect()->route("produksi.show")->with(['success' => ['Data Berhasil Diedit']]);
    }
    public function NProduksiDelete($id)
    {
        $dataGet = $this->neraca->findOrFail($id);
        $dataGet->delete();
        return redirect()->route('produksi.show')->with(['success' => ['Data Berhasil Dihapus']]);
        dd($dataGet);
    }
    // =================================================================================================
    // =============================Neraca Pengeluaran Handler=============================
    public function goToNpengeluaran()
    {
        $kategori = $this->nK->all();
        $neraca = $this->neraca->all();
        return view("pages/neraca_pengeluaran/index", ["neraca" => $neraca, "kategori" => $kategori]);
    }
    public function NPengeluaranEdit($id)
    {
        return redirect('/neracaPengeluaran')->with('idData', $id);
    }
    public function NPengeluaranAdd(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'jenis_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'kegiatan' => 'required',
            'total_sampel' => 'required',
            'target_sampel' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'keterangan' => 'required',
        ]);
        $parrent = [
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'kategori_neraca_id' => strval($this->helper->neracalist($request->nL)),
            'kategori_id' => $request->kategori_kegiatan,
            'kegiatan' => $request->kegiatan,
            'total_sample' => $request->total_sampel != null ? $request->total_sampel : 0,
            'target_sample' => $request->target_sampel,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'keterangan' => $request->keterangan,
        ];
        $this->neraca->create($parrent);
        $child = [];
        if ($request->child_kategori_kegiatan != null) {
            $counter = 0;
            foreach ($request->child_kategori_kegiatan as $data) {
                $this->neracaChild->create([
                    "parent_id" => strval(count($this->neraca->all())),
                    "kategori_id" => $request->child_kategori_kegiatan[$counter],
                    "start" => $request->start[$counter],
                    "end" => $request->end[$counter]
                ]);
                $counter++;
            }
        }
        // dd($child);
        return redirect('neracaPengeluaran')->with(['success' => ['Data Berhasil Ditambah']]);
    }
    public function NPengeluaranUpdate(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'jenis_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'keterangan' => 'required',
        ]);
        // dd($request);
        $parrent =  $this->neraca->find($request->id);
        // dd($parrent);
        $parrent->jenis_kegiatan = $request->jenis_kegiatan;
        $parrent->kategori_id = $request->kategori_kegiatan;
        $parrent->kegiatan = $request->kegiatan;
        $parrent->total_sample = $request->total_sampel != null ? $request->total_sampel : 0;
        $parrent->keterangan = $request->keterangan;
        $parrent->tanggal_mulai = $request->tanggal_mulai;
        $parrent->tanggal_berakhir = $request->tanggal_berakhir;
        $parrent->save();
        if ($request->child_kategori_kegiatan != null) {
            $child = $this->neracaChild->where('parent_id', $request->id)->get();
            $counter = 0;
            foreach ($child as $item) {
                $item->kategori_id = $request->child_kategori_kegiatan[$counter];
                $item->start = $request->start[$counter];
                $item->end = $request->end[$counter];
                $item->save();
                $counter++;
            };
        }
        return redirect()->route("pengeluaran.show")->with(['success' => ['Data Berhasil Diedit']]);
    }
    public function NPengeluaranDelete($id)
    {
        $dataGet = $this->neraca->findOrFail($id);
        $dataGet->delete();
        return redirect()->route('pengeluaran.show')->with(['success' => ['Data Berhasil Dihapus']]);
        dd($dataGet);
    }
    // =================================================================================================
    // =======================================Add Users =================================

    public function goToAddPemantau()
    {
        $users = $this->user->where('email', '!=', 'BPSAdmin@gmail.com')->get();
        return view("pages/addPemantau", compact('users'));
    }

    public function addUser(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];
        // dd($data);
        $this->user->create($data);
        return redirect('goToAddPemantau')->with(['success' => [$data['role'] . ':' . $data['name'] . " Berhasil ditambahkan"]]);
    }
    public function goToEditPemantau($id)
    {
        return redirect()->route('simpanan.goToAddPemantau')->with('userID', $id);
    }
    public function editUser(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];
        $this->user->where('id', $request->id)->update($data);
        return redirect('goToAddPemantau')->with(['success' => [$data['role'] . ':' . $data['name'] . " Berhasil diedit"]]);
    }
    public function deleteUser($id)
    {
        $user = $this->user->where('id', $id)->first();
        $data = [
            'name' => $user->name,
            'role' => $user->role
        ];

        $this->user->where('id', $id)->delete();
        return redirect('goToAddPemantau')->with(['success' => [$data['role'] . ':' . $data['name'] . " Berhasil dihapus"]]);
    }
    // =================================================================================================
    // API to get Neraca data
    public function __invoke()
    {
        return response()->json([
            "data" => $this->helper->neracaJSON()
        ]);
    }
}
