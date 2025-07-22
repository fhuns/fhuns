<?php

namespace App\Observers;

use App\Models\Mahasiswa;

class MahasiswaObserver
{
    public function creating(Mahasiswa $mahasiswa)
    {
        // Isi otomatis tahun dengan tahun sekarang jika kosong
        $mahasiswa->tahun = $mahasiswa->tahun ?? date('Y');
    }
    /**
     * Handle the Mahasiswa "created" event.
     */
    public function created(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "updated" event.
     */
    public function updated(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "deleted" event.
     */
    public function deleted(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "restored" event.
     */
    public function restored(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "force deleted" event.
     */
    public function forceDeleted(Mahasiswa $mahasiswa): void
    {
        //
    }
}
