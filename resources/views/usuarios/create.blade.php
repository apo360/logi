<x-app-layout>
    <x-validation-errors class="mb-4" />

    @if(session('success'))
        <div>
            <div class="font-medium text-green-600">{{ __('Sucesso!') }}</div>

            <p class="mt-3 text-sm text-green-600">
                {{ session('success') }}
            </p>
        </div>
    @endif

    

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <!-- Informações básicas do usuário -->
        <label for="name">Nome:</label>
        <input type="text" name="name" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" required>

        <!-- Dropdown para seleção de função/role -->
        <label for="role">Função:</label>
        <select name="role" required>
            @foreach($roles as $role)
                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
            @endforeach
        </select>

        <span>Checkboxes para seleção de permissões</span>
        <label>Permissões:</label>
        @foreach($permissions as $permission)
            <div>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                <label>{{ $permission->permission_name }}</label>
            </div>
        @endforeach

        <button type="submit">Cadastrar Usuário</button>
    </form>
</x-app-layout>