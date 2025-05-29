<?php
 
namespace App\Livewire\Peminjaman;
 
use App\Models\Peminjaman;
use Livewire\Component;
 
class ListPeminjaman extends Component
{
    /**
     * Menampilkan daftar peminjaman yang ada di database
     * dan mengirimkan data tersebut ke view.
     * Menggunakan model Peminjaman untuk mengambil data peminjaman dari database dengan variabel $peminjamans
     */
    public function render()
    {
        return view('livewire.peminjaman.list-peminjaman', [
            'peminjamans' => Peminjaman::all(),
        ]);
    }
 
    /**
     * Membuat method untuk menghapus data peminjaman
     */
    public function delete($id)
    {
        // Menggunakan model Peminjaman untuk mencari data peminjaman berdasarkan id yang diberikan
        $peminjaman = Peminjaman::find($id);
 
        // Jika data peminjaman ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        // Menggunakan session untuk menyimpan pesan sukses setelah data peminjaman berhasil dihapus
        if ($peminjaman) {
            $peminjaman->delete();
            session()->flash('message', 'Peminjaman ruang berhasil dihapus.');
        }
    }
}