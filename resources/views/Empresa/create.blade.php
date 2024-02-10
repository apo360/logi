<x-config-layout>
    <div class="container mt-5">
        <form action="{{ route('empresa.store') }}" method="post">
            @csrf
            <!-- Nome da Empresa -->
            <div class="form-group">
                <label for="nome_empresa">Nome da Empresa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" required>
                @error('nome_empresa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nif">NIF <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nif" name="nif" required>
                @error('nif')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nif">Seu Nome <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo Designação (inicialmente oculto) -->
            <div class="form-group" id="campo_designacao" style="display: none;">
                <label for="designacao">Designação</label>
                <select class="form-control" id="designacao" name="designacao">
                    <option value="Despachante Oficial">Despachante Oficial</option>
                    <option value="Praticante">Praticante</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>

            <!-- Campo Cédula (inicialmente oculto) -->
            <div class="form-group" id="campo_cedula" style="display: none;">
                <label for="cedula">Cédula <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="cedula" name="cedula" value="{{ old('cedula') }}">
                    <div class="input-group-append">
                        <a href="#" id="val_cedula" class="btn btn-dark">Validar <i class="fas fa-check"></i> </a>
                    </div>
                </div>
                @error('cedula')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            


            <!-- Campo de seleção para atividades comerciais -->
            <div class="form-group">
                <label for="atividade_comercial">Atividade Comercial <span class="text-danger">*</span></label>
                <select class="form-control" id="atividade_comercial" name="atividade_comercial[]" multiple required>
                    <option value="Despachante Aduaneiro">Despachante Aduaneiro</option>
                    <option value="Consultoria Empresarial">Consultoria Empresarial</option>
                    <option value="Comércio Varejista">Comércio Varejista</option>
                    <option value="Comércio Atacadista">Comércio Atacadista</option>
                    <option value="Serviços de Tecnologia da Informação">Serviços de Tecnologia da Informação</option>
                    <option value="Serviços de Marketing Digital">Serviços de Marketing Digital</option>
                    <option value="Restaurante/Café">Restaurante/Café</option>
                    <option value="Arquitetura e Design de Interiores">Arquitetura e Design de Interiores</option>
                    <option value="Construção Civil">Construção Civil</option>
                    <option value="Serviços de Contabilidade">Serviços de Contabilidade</option>
                    <option value="Serviços Jurídicos">Serviços Jurídicos</option>
                    <option value="Saúde e Bem-estar">Saúde e Bem-estar</option>
                    <option value="Educação e Treinamento">Educação e Treinamento</option>
                    <option value="Agência de Viagens">Agência de Viagens</option>
                    <option value="Agricultura e Agropecuária">Agricultura e Agropecuária</option>
                    <option value="Energias Renováveis">Energias Renováveis</option>
                    <option value="Serviços de Transporte">Serviços de Transporte</option>
                    <option value="Manufatura">Manufactura</option>
                    <option value="E-commerce">E-commerce</option>
                    <option value="Imobiliária">Imobiliária</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>
            

            <!-- Campo de checkboxes para serviços -->
            <div class="form-group">
                <label>Serviços <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico1" name="servicos[]" value="Desenvolvimento de Software">
                            <label class="form-check-label" for="servico1">Desenvolvimento de Software</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico2" name="servicos[]" value="Consultoria Financeira">
                            <label class="form-check-label" for="servico2">Consultoria Financeira</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico3" name="servicos[]" value="Design Gráfico">
                            <label class="form-check-label" for="servico3">Design Gráfico</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico4" name="servicos[]" value="Desenvolvimento Web">
                            <label class="form-check-label" for="servico4">Desenvolvimento Web</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico5" name="servicos[]" value="Manutenção de Equipamentos Eletrônicos">
                            <label class="form-check-label" for="servico5">Manutenção de Equipamentos Eletrônicos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico6" name="servicos[]" value="Serviços de Limpeza Residencial/Comercial">
                            <label class="form-check-label" for="servico6">Serviços de Limpeza Residencial/Comercial</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico7" name="servicos[]" value="Serviços de Paisagismo">
                            <label class="form-check-label" for="servico7">Serviços de Paisagismo</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico8" name="servicos[]" value="Fotografia e Vídeo">
                            <label class="form-check-label" for="servico8">Fotografia e Vídeo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico9" name="servicos[]" value="Treinamento Fitness/Personal Trainer">
                            <label class="form-check-label" for="servico9">Treinamento Fitness/Personal Trainer</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico10" name="servicos[]" value="Serviços de Tradução">
                            <label class="form-check-label" for="servico10">Serviços de Tradução</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico11" name="servicos[]" value="Serviços de Limpeza de Carpetes">
                            <label class="form-check-label" for="servico11">Serviços de Limpeza de Carpetes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico12" name="servicos[]" value="Serviços de Coaching">
                            <label class="form-check-label" for="servico12">Serviços de Coaching</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico13" name="servicos[]" value="Manutenção de Veículos">
                            <label class="form-check-label" for="servico13">Manutenção de Veículos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico14" name="servicos[]" value="Serviços de Corte e Costura">
                            <label class="form-check-label" for="servico14">Serviços de Corte e Costura</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico15" name="servicos[]" value="Organização de Eventos">
                            <label class="form-check-label" for="servico15">Organização de Eventos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico16" name="servicos[]" value="Serviços de Delivery">
                            <label class="form-check-label" for="servico16">Serviços de Delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico17" name="servicos[]" value="Serviços de Design de Moda">
                            <label class="form-check-label" for="servico17">Serviços de Design de Moda</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico18" name="servicos[]" value="Serviços de Marketing de Conteúdo">
                            <label class="form-check-label" for="servico18">Serviços de Marketing de Conteúdo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico19" name="servicos[]" value="Reparo de Equipamentos Eletrônicos">
                            <label class="form-check-label" for="servico19">Reparo de Equipamentos Eletrônicos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servico20" name="servicos[]" value="Consultoria em Recursos Humanos">
                            <label class="form-check-label" for="servico20">Consultoria em Recursos Humanos</label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="logotipo">Logotipo</label>
                <input type="text" class="form-control" id="logotipo" name="logotipo">
            </div>

            <!-- Campo CodFactura -->
            <div class="form-group">
                <label for="cod_factura">Código da Fatura</label>
                <input type="text" class="form-control" id="cod_factura" name="cod_factura">
            </div>

            <!-- Campo CodProcesso -->
            <div class="form-group">
                <label for="cod_processo">Código do Processo</label>
                <input type="text" class="form-control" id="cod_processo" name="cod_processo">
            </div>

            <!-- Campo Slogan -->
            <div class="form-group">
                <label for="slogan">Slogan</label>
                <input type="text" class="form-control" id="slogan" name="slogan">
            </div>

            <!-- Campo Endereco_completo -->
            <div class="form-group">
                <label for="endereco_completo">Endereço Completo</label>
                <input type="text" class="form-control" id="endereco_completo" name="endereco_completo">
            </div>

            <!-- Campo Provincia -->
            <div class="form-group">
                <label for="provincia">Província</label>
                <input type="text" class="form-control" id="provincia" name="provincia">
            </div>

            <!-- Campo Cidade -->
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade">
            </div>

            <!-- Campo Dominio -->
            <div class="form-group">
                <label for="dominio">Domínio</label>
                <input type="text" class="form-control" id="dominio" name="dominio">
            </div>

            <!-- Campo Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <!-- Campo Fax -->
            <div class="form-group">
                <label for="fax">Fax</label>
                <input type="text" class="form-control" id="fax" name="fax">
            </div>

            <!-- Campo Contacto_movel -->
            <div class="form-group">
                <label for="contacto_movel">Contacto Móvel</label>
                <input type="tel" class="form-control" id="contacto_movel" name="contacto_movel">
            </div>

            <!-- Campo Contacto_fixo -->
            <div class="form-group">
                <label for="contacto_fixo">Contacto Fixo</label>
                <input type="tel" class="form-control" id="contacto_fixo" name="contacto_fixo">
            </div>

            <div class="form-group">
                <label for="banco">Banco</label>
                <input type="text" class="form-control" id="banco" name="banco">
            </div>

            <div class="form-group">
                <label for="conta_bancaria">Número de Conta Bancária</label>
                <input type="text" class="form-control" id="conta_bancaria" name="conta_bancaria">
            </div>

            <div class="form-group">
                <label for="iban">IBAN</label>
                <input type="text" class="form-control" id="iban" name="iban">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Dados</button>
        </form>
    </div>

<script>
    // Função para mostrar ou ocultar campos com base na seleção
    $(document).ready(function () {
        $('#atividade_comercial').change(function () {
            var selectedOption = $(this).val();

            // Resetar campos
            $('#campo_designacao').hide();
            $('#campo_cedula').hide();

            // Mostrar campos conforme a seleção
            if (selectedOption.includes('Despachante Aduaneiro')) {
                $('#campo_designacao').show();
                $('#campo_cedula').show();
            }
        });
    });
</script>
</x-config-layout>
