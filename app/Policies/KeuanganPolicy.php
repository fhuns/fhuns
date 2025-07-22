<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Keuangan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeuanganPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Semua user bisa melihat
    }

    public function view(User $user, Keuangan $keuangan)
    {
        return true; // Semua user bisa melihat detail
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Keuangan $keuangan)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Keuangan $keuangan)
    {
        return $user->role === 'admin';
    }
}