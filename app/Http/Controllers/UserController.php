<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class UserController extends Controller
{

    use PasswordValidationRules;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('usuarios.create', compact('roles', 'permissions'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [$this->passwordRules(), 'confirmed'],
        ]);

        $user = Auth::user();

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->password),
            'password_change_required' => true, // Marque como true(1) para indicar que a senha foi alterada
            'password_expired' => now()->addDays(60), // Defina a nova data de expiração, por exemplo, 60 dias a partir de agora
        ]);

        // Redirecionar ou retornar uma resposta, dependendo das necessidades do seu aplicativo
        return redirect()->route('dashboard')->with('success', 'Senha atualizada com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => $this->passwordRules(),
            'role' => 'required|exists:roles,id',
            'permissions' => 'array', // Pode precisar de validação adicional dependendo da sua lógica
        ]);

        // Crie o usuário
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Certifique-se de criptografar a senha
            'role_id' => $validatedData['role'],
        ]);

        // Se houver permissões selecionadas, associe-as ao usuário
        if (isset($validatedData['permissions'])) {
            $user->permissions()->sync($validatedData['permissions']);
        }

        // Faça qualquer outra coisa necessária após a criação do usuário, se aplicável

        // Redirecione ou retorne uma resposta adequada
        return redirect()->back()->with('',''); // Substitua 'nome_da_rota' pela rota apropriada
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
