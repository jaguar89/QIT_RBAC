<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AllAdmins extends Component
{
    public $admins;

    public function mount()
    {
        $this->admins = User::role('admin')->get();
    }

    public function render()
    {
        return view('livewire.admin.all-admins')->layout('layouts.app');
    }

    public function deleteAdmin($id)
    {
        $admin = User::role('admin')->find($id);

        if ($admin) {
            $admin->delete();
            session()->flash('success', 'Admin deleted successfully.');
        } else {
            session()->flash('error', 'Admin not found.');
        }

        $this->redirect('/admins', navigate: true);
    }
}
