<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Pegawai {{ $nip }}</h1>
    <form wire:submit.prevent="save" class="space-y-4">
        <flux:input type="text" id="nip" wire:model.defer="nip" label="NIP Pegawai"
            placeholder="Masukkan NIP Pegawai" required />
        <flux:input type="text" id="nama" wire:model.defer="nama" label="Nama Pegawai"
            placeholder="Masukkan Nama Pegawai" required />
        <flux:input type="text" id="unit_kerja_id" wire:model.defer="unit_kerja_id" label="ID Unit Kerja" 
            placeholder="Masukan ID unit kerja pegawai" required />
        <flux:button type="submit" variant="primary">
            Save
        </flux:button>
    </form>
</div>
