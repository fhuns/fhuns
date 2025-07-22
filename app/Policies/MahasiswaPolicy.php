<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Auth\Access\HandlesAuthorization;

class MahasiswaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Semua user bisa melihat
    }

    public function view(User $user, Mahasiswa $mahasiswa)
    {
        return true; // Semua user bisa melihat detail
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Mahasiswa $mahasiswa)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Mahasiswa $mahasiswa)
    {
        return $user->role === 'admin';
    }
}