@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ $message }}</p>
@enderror
<!--  
Tenho uma aluno, matriculado em uma classe de um determinado turno que pertence a um curso
tabelas
{
    Projetos[] --<> ligado aos alunos, professor(tutores)
    Aulas[] --<> lições dadas, ligado com o professor e a disciplina
    Notas[] --<> notas do aluno inseridas pelo professor (nesta tabela pode ter todas as notas de uma determinada prova que o aluno pode ter)
    Faltas[] --<> faltas do aluno inseridas pelo professor
    Recursos[] --<> (caso aplicavel) de uma determinada disciplina que não teve nota suficiente
    Requisicoes[]  --<> documentos pedidos pelos alunos (declarações, certificados, transferencias)
    Mapa[] --<> mapa de notas
    pessoa
    [
        Alunos
        [
            ID-Aluno, 
            ID-geral, 
            ID-pessoa,..., 
            Tipo_Aluno{...},
            Matricula
            [
                ID-Aluno, 
                ID-Matricula, 
                Nº Matricula, 
                Classe
                [
                    ID, 
                    classe, 
                    ensino(Primario, Secundario, Medio, Tecnico)
                ], 
                Curso
                [
                    ID, 
                    Nome,
                    ...
                ],
                Turno
                [
                    ID, 
                    Nome, 
                    ...
                ],
                Estado
            ],
        ],
        Professores
        (
            ID-Professor, 
            ID-geral, 
            ID-pessoa, 
            Tipo_Professor
            [
                Coordenador-Curso,
                Tutor/Orientador
            ], dispilinas, classe
        ),
        Funcionarios
        (
            ID-Funcionario,
            ID-pessoa,
            Tipo_funcionario
            [
                Administradores,
                Administrativos,
                Bibiotecario(a),
                ...
            ]),
        Pais(ID-Pais, ID-pessoa, ...),
        Endereco[ID-Endereco, ID-Pessoa, ...],
        Contacto[ID-Contacto, ID-Pessoa, ...]
    ]
}
-->