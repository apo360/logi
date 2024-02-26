<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\DatabaseErrorHandler;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
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

        // Recupera o usuário autenticado
        $loggedInUser = auth()->user();

        $tableDataUser = [
            'headers' => ['Nº', 'Cod Usuário', 'Nome', 'E-mail','Último Acesso', 'Regra', 'Ações'],
            'rows' => [],
        ];

        // Verifica se o usuário autenticado pertence a uma empresa
        if ($loggedInUser->empresa) {
            // Listar todos os Usuarios da mesma empresa
            $users = User::where('FK_Empresa', $loggedInUser->FK_Empresa)->get();

            foreach ($users as $key => $user) {
                $tableDataUser['rows'][] = [
                    $key + 1,
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->last_access,
                    $user->role->role_name,
                    '
                       <div class="inline-flex">
                        <a href="' . route('usuarios.show', ['usuario' => $user->id]) . '" class="dropdown-item" data-toggle="tooltip" title="Detalhe"> <i class="fas fa-user"></i> </a>
                        <a href="' . route('usuarios.edit', $user->id) . '" class="dropdown-item" data-toggle="tooltip" title="Editar"> <i class="fas fa-edit"></i> </a>
                        <a href="' .  route('usuarios.destroy', $user->id) . '" class="dropdown-item" style="color: red;" onclick="event.preventDefault(); 
                            if (confirm("Tem certeza de que deseja apagar?")) 
                            { 
                                document.getElementById("delete-form-'.$user->id.'").submit(); 
                            }" data-toggle="tooltip" title="Apagar">
                            <i class="fas fa-trash" style="color: red;"></i>
                        </a>
    
                        <form id="delete-form-{{ $user->id }}" action="' . route('usuarios.destroy', $user->id) . '" method="POST" style="display: none;">
                            @csrf
                            @method('.'DELETE'.')
                        </form>
    
                       </div>         
                    ',
                ];
            }
    
            return view('usuarios.index', compact('tableDataUser'));
        }
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
            'password' => 'required|string',
            'role' => 'required|exists:roles,role_id',
            'permissions' => 'array', // Pode precisar de validação adicional dependendo da sua lógica
        ]);

        try {
            // Crie o usuário
            $newUser = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']), // Certifique-se de criptografar a senha
                'password_change_required' => false, // Marque como false para indicar que a senha deve ser alterada
                'password_expired' => now()->addDays(45), // Defina a nova data de expiração, por exemplo, 30 dias a partir de agora
                'status' => 'Activo',
                'Fk_Role' => $validatedData['role'],
                'FK_Empresa' => auth()->user()->empresa->Id,
            ]);


            // Se houver permissões selecionadas, associe-as ao usuário
            if (isset($validatedData['permissions'])) {
                $newUser->permissions()->sync($validatedData['permissions']);
            }

            // Faça qualquer outra coisa necessária após a criação do usuário, se aplicável
            return redirect()->back()->with('success','Usuario Criado com sucesso!'); 

        } catch (QueryException $e) {
            return DatabaseErrorHandler::handle($e);
        }
        
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
