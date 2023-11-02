<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Funcionario;

class FuncionarioModelTest extends TestCase
{
    public function testContratoMethod()
    {
        // Crie uma instância do modelo Funcionario (ou use uma instância real, se aplicável)
        $funcionario = new Funcionario();

        // Chame o método contrato
        $contrato = $funcionario->contrato();

        // Realize verificações nos resultados
        $this->assertNotNull($contrato); // Verifique se o método retorna um contrato (ou nulo, se não houver contrato)

        // Exemplo: Verifique se o contrato é do tipo Contrato
        $this->assertInstanceOf(Contrato::class, $contrato);
    }
}
