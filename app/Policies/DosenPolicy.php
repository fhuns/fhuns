<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Auth\Access\HandlesAuthorization;

class DosenPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Semua user bisa melihat
    }

    public function view(User $user, Dosen $dosen)
    {
        return true; // Semua user bisa melihat detail
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Dosen $dosen)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Dosen $dosen)
    {
        return $user->role === 'admin';
    }
}