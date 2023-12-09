<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ManageAdmin extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $formHeading = 'Create Admin';
    public string $passwordLabel = 'Password';
    public string $confirmedPasswordLabel = 'Confirm Password';
    public $permissions = [
        'dashboard-access' => false,
        'read-categories' => false,
        'create-categories' => false,
        'update-categories' => false,
        'delete-categories' => false,
        'read-products' => false,
        'create-products' => false,
        'update-products' => false,
        'delete-products' => false,
    ];
    public $admin;

    public function mount($id = null)
    {
        if ($id) {
            $this->admin = User::findOrFail($id);
            if ($this->admin && $this->admin->hasRole('admin')) {
                $this->name = $this->admin->name;
                $this->email = $this->admin->email;
                foreach ($this->admin->getPermissionNames() as $value) {
                    $this->permissions[$value] = true;
                }
            } else {
                abort(404);
            }
            $this->formHeading = 'Update Admin';
            $this->passwordLabel = 'New Password (optional)';
            $this->confirmedPasswordLabel = 'Confirm New Password';
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-admin')->layout('layouts.app');
    }

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                $this->admin ? Rule::unique(User::class)->ignore($this->admin->id) : 'unique:users',
            ],
            'password' =>
                $this->admin ? ['sometimes','string','confirmed',Password::defaults()] : ['required','string','confirmed',Password::defaults()]
        ]);


        $validated['password'] = Hash::make($validated['password']);

        if($this->admin){
            // update
            $this->admin->update($validated);
            $this->admin->syncPermissions(array_keys(array_filter($this->permissions)));
        }else{
            // create
            $user = User::create($validated);
            $user->assignRole('admin');
            foreach ($this->permissions as $permission => $value) {
                if ($value) {
                    $user->givePermissionTo($permission);
                }
            }
        }
        $this->redirect('/admins', navigate: true);
    }
}
