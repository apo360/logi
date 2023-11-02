
    <style>
        /* Estilos CSS para o rodapé */
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
        }
    </style>

    <div class="footer">
        <p>Rodapé do PDF - Data: {{ date('Y-m-d') }}</p>
        <div class="footer">
            <p>Informações do Rodapé</p>
            <table>
                <tr>
                    <th>Telefone</th>
                    <th>Fax</th>
                    <th>Email</th>
                    <!-- Adicione outras colunas desejadas -->
                </tr>
                @foreach ($footer as $item)
                <tr>
                    <td>{{ $item->Telefone }}</td>
                    <td>{{ $item->Fax }}</td>
                    <td>{{ $item->Email }}</td>
                    <!-- Preencha outras colunas com os respectivos valores do modelo -->
                </tr>
                @endforeach
            </table>
        </div>

    </div>

