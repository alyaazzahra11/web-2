<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Peminjaman</h1>
    <form wire:submit.prevent="save" class="space-y-4">
        <flux:input type="text" id="ruang_id" wire:model.defer="ruang_id" label="ID Ruang"
            placeholder="Masukkan ID Ruang" required />
        <flux:input type="text" id="pegawai_id" wire:model.defer="pegawai_id" label="ID Pegawai"
            placeholder="Masukkan ID Pegawai" required />
        <flux:input type="date" id="tanggal" wire:model.defer="tanggal" label="ID tanggal"
            placeholder="Masukkan Tanggal" required />
        <flux:input type="time" id="jam_mulai" wire:model.defer="jam_mulai" label="Jam Mulai"
            placeholder="Masukkan Jam Mulai" required />
        <flux:input type="time" id="jam_akhir" wire:model.defer="jam_akhir" label="Jam Akhir"
            placeholder="Masukkan Jam Akhir" required />
        <flux:input type="text" id="keterangan" wire:model.defer="keterangan" label="Keterangan"
            placeholder="Masukkan Keterangan" required />
        <flux:button type="submit" variant="primary">
            Save
        </flux:button>
    </form>
</div>