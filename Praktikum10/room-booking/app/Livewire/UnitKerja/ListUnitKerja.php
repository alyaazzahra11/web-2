<?php
 
namespace App\Livewire\UnitKerja;
 
use App\Models\UnitKerja;
use Livewire\Component;
 
class ListUnitKerja extends Component
{
    /**
     * Menampilkan daftar unit kerja yang ada di database
     * dan mengirimkan data tersebut ke view.
     * Menggunakan model unit kerja untuk mengambil data unit kerja dari database dengan variabel $unitkerjas
     */
    public function render()
    {
        return view('livewire.unit-kerja.list-unit-kerja', [
            'unitkerjas' => UnitKerja::all(),
        ]);
    }
 
    /**
     * Membuat method untuk menghapus data unit kerja
     */
    public function delete($id)
    {
        // Menggunakan model unit kerja untuk mencari data unit kerja berdasarkan id yang diberikan
        $unitkerja = UnitKerja::find($id);
 
        // Jika data unit kerja ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        // Menggunakan session untuk menyimpan pesan sukses setelah data unit kerja berhasil dihapus
        if ($unitkerja) {
            $unitkerja->delete();
            session()->flash('message', 'Unit kerja berhasil dihapus.');
        }
    }
}