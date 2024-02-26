<x-config-layout>
    <div class="container mt-4">
        <form action="{{ route('empresa.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="container">
                    <div class="col-md-8">
                        <div class="card card-dark">
                            <div class="card-header">
                                <div class="card-title">
                                    <span>Configurações Basícas</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mt-2">
                                        <label for="nif">NIF <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nif" name="nif" required style="border: 0px; border-bottom: 1px solid black;">
                                        @error('nif')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <!-- Nome da Empresa -->
                                    <div class="form-group mt-2">
                                        <label for="Empresa">Nome da Empresa <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="Empresa" name="Empresa" style="border: 0px; border-bottom: 1px solid black;" required>
                                        @error('Empresa')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nif">Seu Nome <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" style="border: 0px; border-bottom: 1px solid black;" required>
                                @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contacto_movel">Contacto<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contacto_movel" name="contacto_movel" style="border: 0px; border-bottom: 1px solid black;" required>
                                @error('contacto_movel')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo de seleção para atividades comerciais -->

                            <div class="form-group">
                                <label for="atividade_comercial">Atividade Comercial</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%; border: 0px; border-bottom: 1px solid black;" id="atividade_comercial" name="atividade_comercial[]" required>
                                        <option value="Despachante Aduaneiro">Despachante Aduaneiro</option>
                                        <option value="Consultoria Empresarial">Consultoria Empresarial</option>
                                        <!-- <option value="Comércio Retalho">Comércio Retalho</option> -->
                                        <!-- <option value="Comércio Grosso">Comércio Grosso</option> -->
                                        <option value="Serviços de Tecnologia da Informação">Serviços de TI</option>
                                        <!-- <option value="Serviços de Marketing Digital">Serviços de Marketing Digital</option> -->
                                        <!-- <option value="Restaurante/Café">Restaurante/Café</option> -->
                                        <option value="Arquitetura e Design de Interiores">Arquitetura e Design de Interiores</option>
                                        <!-- <option value="Construção Civil">Construção Civil</option> -->
                                        <option value="Serviços de Contabilidade">Serviços de Contabilidade</option>
                                        <!-- <option value="Serviços Jurídicos">Serviços Jurídicos</option> -->
                                        <!-- <option value="Saúde e Bem-estar">Saúde e Bem-estar</option> -->
                                        <option value="Educação e Treinamento">Educação e Treinamento</option>
                                        <!-- <option value="Agência de Viagens">Agência de Viagens</option> -->
                                        <!-- <option value="Agricultura e Agropecuária">Agricultura e Agropecuária</option> -->
                                        <option value="Energias Renováveis">Energias Renováveis</option>
                                        <!-- <option value="Serviços de Transporte">Serviços de Transporte</option> -->
                                        <!-- <option value="Manufatura">Manufactura</option> -->
                                        <!-- <option value="E-commerce">E-commerce</option> -->
                                        <!-- <option value="Imobiliária">Imobiliária</option> -->
                                    </select>
                                </div>
                                @error('atividade_comercial')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campos Ocultos só aparecem caso o tipo de Actividade for Despachante Aduaneiro -->

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <!-- Campo Cédula (inicialmente oculto) -->
                                    <div class="form-group" id="campo_cedula" style="display: none;">
                                        <label for="cedula">Cédula <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="cedula" name="cedula" value="{{ old('cedula') }}" style="border: 0px; border-bottom: 1px solid black;">
                                            <div class="input-group-append">
                                                <a href="#" id="val_cedula" class="btn btn-dark">Validar <i class="fas fa-check"></i> </a>
                                            </div>
                                        </div>
                                        @error('cedula')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Campo Designação (inicialmente oculto) -->
                                    <div class="form-group" id="campo_designacao" style="display: none;">
                                        <label for="designacao">Designação</label>
                                        <select class="form-control" id="designacao" name="designacao" style="border: 0px; border-bottom: 1px solid black;">
                                            <option value="Despachante Oficial">Despachante Oficial</option>
                                            <option value="Praticante">Praticante</option>
                                            <option value="Outro">Outro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Campo de checkboxes para serviços -->
                            <!-- iCheck -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Escolha os Serviços </h3>
                                </div>
                                <div class="card-body">
                                <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="checkbox" id="servico1" name="servicos[]" value="Desenvolvimento de Software">
                                            <label class="form-check-label" for="servico1">Desenvolvimento de Software</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="checkbox" id="servico2" name="servicos[]" value="Consultoria Financeira">
                                            <label class="form-check-label" for="servico2">Consultoria Financeira</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="checkbox" id="servico3" name="servicos[]" value="Design Gráfico">
                                            <label class="form-check-label" for="servico3">Design Gráfico</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="checkbox" id="servico4" name="servicos[]" value="Desenvolvimento Web">
                                            <label class="form-check-label" for="servico4">Desenvolvimento Web</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="checkbox" id="servico5" name="servicos[]" value="Manutenção de Equipamentos Eletrônicos">
                                            <label class="form-check-label" for="servico5">Manutenção de Equipamentos Eletrônicos</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="checkbox" id="servico6" name="servicos[]" value="Serviços de Limpeza Residencial/Comercial">
                                            <label class="form-check-label" for="servico6">Serviços de Limpeza Residencial/Comercial</label>
                                        </div>
                                        <div class="icheck-primary d-inline">
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
                                </div>
                            </div>
                            <!-- /.card -->
                        
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value ="Salvar Dados">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>

            
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Adicione o seguinte antes da tag </body> do seu HTML -->
<script>
    $(document).ready(function () {
        // Evento de mudança no campo de atividade comercial
        $('#atividade_comercial').change(function () {
            // Recupere os valores selecionados
            var atividadesSelecionadas = $(this).val();

            // Oculte todos os campos adicionais inicialmente
            $('#campo_designacao, #campo_cedula').hide();

            // Verifique se "Despachante Aduaneiro" está entre as atividades selecionadas
            if (atividadesSelecionadas && atividadesSelecionadas.includes('Despachante Aduaneiro')) {
                // Se sim, mostre os campos adicionais
                $('#campo_designacao, #campo_cedula').show();
            }
        });

        // Evento de clique no botão de validação de cédula
        $('#val_cedula').click(function (e) {
            // Adicione aqui a lógica para validar a cédula
            // Você pode usar AJAX para fazer uma solicitação ao servidor, por exemplo
            e.preventDefault();
            alert('Validação de cédula será implementada aqui.');
        });
    });
</script>

</x-config-layout>
