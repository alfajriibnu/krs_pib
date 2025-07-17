<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\MataKuliah;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $tahunAkademik = TahunAkademik::where('is_active', true)->first();
        if (!$tahunAkademik) {
            return redirect()->back()->with('error', 'Tidak ada tahun akademik aktif.');
        }

        // Cari atau buat data KRS (1 per semester per mahasiswa)
        $krs = Krs::firstOrCreate([
            'mahasiswa_id' => $mahasiswa->id,
            'tahun_akademik_id' => $tahunAkademik->id,
        ], [
            'status' => 'draft'
        ]);

        // Ambil matkul berdasarkan prodi & semester mahasiswa
        $mataKuliah = MataKuliah::where('prodi_id', $mahasiswa->prodi_id)
            ->where('semester', $mahasiswa->semester)
            ->get();

        $selectedMatkul = $krs->details->pluck('mata_kuliah_id')->toArray();

        return view('mahasiswa.krs.index', compact('krs', 'mataKuliah', 'selectedMatkul', 'tahunAkademik'));
    }

    public function store(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $tahunAkademik = TahunAkademik::where('is_active', true)->firstOrFail();

        $request->validate([
            'mata_kuliah_id' => 'required|array|min:1',
            'mata_kuliah_id.*' => 'exists:mata_kuliah,id',
        ]);

        $mataKuliahDipilih = MataKuliah::whereIn('id', $request->mata_kuliah_id)->get();
        $totalSks = $mataKuliahDipilih->sum('sks');

        if ($totalSks > 24) {
            return redirect()->back()->with('error', 'Total SKS melebihi batas maksimal 24 SKS. Anda memilih ' . $totalSks . ' SKS.');
        }

        // Cek apakah sudah ada KRS draft atau buat baru
        $krs = Krs::updateOrCreate(
            [
                'mahasiswa_id' => $mahasiswa->id,
                'tahun_akademik_id' => $tahunAkademik->id,
            ],
            ['status' => 'draft']
        );

        // Hapus data lama lalu simpan ulang
        $krs->details()->delete();

        foreach ($mataKuliahDipilih as $mk) {
            $krs->details()->create([
                'mata_kuliah_id' => $mk->id
            ]);
        }

        return redirect()->back()->with('success', 'KRS berhasil disimpan dengan total ' . $totalSks . ' SKS.');
    }

    public function ajukan(Krs $krs)
    {
        // Pastikan mahasiswa yang login adalah pemilik KRS
        if ($krs->mahasiswa_id !== auth()->user()->mahasiswa->id) {
            abort(403, 'Anda tidak berhak mengakses KRS ini.');
        }

        // Pastikan KRS berstatus draft
        if ($krs->status !== 'draft') {
            return redirect()->back()->with('error', 'KRS sudah diajukan atau diproses.');
        }

        // Pastikan minimal ada 1 mata kuliah
        if ($krs->details()->count() === 0) {
            return redirect()->back()->with('error', 'Pilih mata kuliah terlebih dahulu sebelum mengajukan.');
        }

        $krs->update(['status' => 'diajukan']);

        return redirect()->back()->with('success', 'KRS berhasil diajukan ke dosen wali.');
    }

    public function riwayat()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $riwayat = Krs::with(['tahunAkademik', 'details.mataKuliah'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', ['diajukan', 'disetujui', 'ditolak'])
            ->orderByDesc('created_at')
            ->get();

        return view('mahasiswa.krs.riwayat', compact('riwayat'));
    }

    public function cetak($id)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $krs = Krs::with(['tahunAkademik', 'details.mataKuliah', 'mahasiswa.prodi', 'dosenWali'])
            ->where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->firstOrFail();

        // Ganti karakter "/" jadi "-" agar aman untuk nama file
        $tahun = str_replace('/', '-', $krs->tahunAkademik->tahun);

        $pdf = Pdf::loadView('mahasiswa.krs.cetak', compact('krs'))->setPaper('A4', 'portrait');
        return $pdf->stream('KRS_' . $tahun . '.pdf');
    }
}
