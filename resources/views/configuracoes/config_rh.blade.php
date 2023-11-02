<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Configurações" breadcrumb="Configurações de RH" />
    </x-slot>

    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#faltas" class="nav-link active" roles="tab" data-toggle="tab">Faltas</a>
            </li>
            <li class="nav-item">
                <a href="#attendance" class="nav-link" roles="tab" data-toggle="tab">Abonos e Descontos</a>
            </li>
            <li class="nav-item">
                <a href="#lutas" class="nav-link" roles="tab" data-toggle="tab">Certificações e Skills</a>
            </li>
            <li class="nav-item">
                <a href="#lutas" class="nav-link" roles="tab" data-toggle="tab">Historico</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="faltas">
                <h1>Tipos de Faltas dos Funcionários</h1>
                <form action="processar_formulario.php" method="POST">
                    <label for="nome_falta">Nome da Falta:</label>
                    <input type="text" id="nome_falta" name="nome_falta" required>
                    <br>

                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea>
                    <br>

                    <label for="politica">Política de Falta:</label>
                    <select id="politica" name="politica">
                        <option value="desconto_no_salario">Desconto no Salário</option>
                        <option value="dias_descontados">Dias Descontados</option>
                        <option value="sem_efeito_no_salario">Sem Efeito no Salário</option>
                    </select>
                    <br>

                    <input type="submit" value="Salvar">
                </form>
            </div>
        </div>

    </div>
</x-app-layout>