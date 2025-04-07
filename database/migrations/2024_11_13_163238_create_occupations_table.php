<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $occupations = [
            ['name' => 'Administrador de Rede'],
            ['name' => 'Administrador(a)'],
            ['name' => 'Administrador(a) de Banco de Dados'],
            ['name' => 'Administrador(a) de Empresas'],
            ['name' => 'Administrador(a) de Recursos Humanos'],
            ['name' => 'Administrador(a) Hospitalar'],
            ['name' => 'Advogado(a)'],
            ['name' => 'Advogado(a) Autônomo(a)'],
            ['name' => 'Agente de Atendimento'],
            ['name' => 'Agente de Coleta'],
            ['name' => 'Agente de Vendas'],
            ['name' => 'Agente de Viagens'],
            ['name' => 'Analista Administrativo(a)'],
            ['name' => 'Analista Contábil'],
            ['name' => 'Analista de Atendimento'],
            ['name' => 'Analista de Comunicação'],
            ['name' => 'Analista de Controladoria'],
            ['name' => 'Analista de Crédito'],
            ['name' => 'Analista de Desenvolvimento de Sistemas'],
            ['name' => 'Analista de Estoque'],
            ['name' => 'Analista de Exportação'],
            ['name' => 'Analista de Importação'],
            ['name' => 'Analista de Marketing'],
            ['name' => 'Analista de Negócios'],
            ['name' => 'Analista de Planejamento'],
            ['name' => 'Analista de Produção'],
            ['name' => 'Analista de Recursos Humanos'],
            ['name' => 'Analista de Relações Públicas'],
            ['name' => 'Analista de Segurança da Informação'],
            ['name' => 'Analista de Suporte Técnico'],
            ['name' => 'Analista de Sistemas'],
            ['name' => 'Analista Financeiro(a)'],
            ['name' => 'Analista Fiscal'],
            ['name' => 'Analista de Testes'],
            ['name' => 'Analista Tributário(a)'],
            ['name' => 'Arquiteto(a)'],
            ['name' => 'Arquiteto(a) de Interiores'],
            ['name' => 'Arquiteto(a) de Sistemas'],
            ['name' => 'Assistente Administrativo(a)'],
            ['name' => 'Assistente Comercial'],
            ['name' => 'Assistente Contábil'],
            ['name' => 'Assistente de Atendimento'],
            ['name' => 'Assistente de Compras'],
            ['name' => 'Assistente de Comunicação'],
            ['name' => 'Assistente de Contas a Pagar'],
            ['name' => 'Assistente de Contas a Receber'],
            ['name' => 'Assistente de Crédito'],
            ['name' => 'Assistente de Estoque'],
            ['name' => 'Assistente de Exportação'],
            ['name' => 'Assistente de Importação'],
            ['name' => 'Assistente de Marketing'],
            ['name' => 'Assistente de Negócios'],
            ['name' => 'Assistente de Planejamento'],
            ['name' => 'Assistente de Produção'],
            ['name' => 'Assistente de Recursos Humanos'],
            ['name' => 'Assistente de Segurança do Trabalho'],
            ['name' => 'Assistente de Suporte Técnico'],
            ['name' => 'Assistente de TI'],
            ['name' => 'Assistente Financeiro(a)'],
            ['name' => 'Assistente Fiscal'],
            ['name' => 'Assistente Jurídico(a)'],
            ['name' => 'Assistente Social'],
            ['name' => 'Auditor(a)'],
            ['name' => 'Auxiliar Administrativo(a)'],
            ['name' => 'Auxiliar Contábil'],
            ['name' => 'Auxiliar de Atendimento'],
            ['name' => 'Auxiliar de Compras'],
            ['name' => 'Auxiliar de Crédito'],
            ['name' => 'Auxiliar de Escritório'],
            ['name' => 'Auxiliar de Estoque'],
            ['name' => 'Auxiliar de Expedição'],
            ['name' => 'Auxiliar de Importação'],
            ['name' => 'Auxiliar de Manutenção'],
            ['name' => 'Auxiliar de Marketing'],
            ['name' => 'Auxiliar de Produção'],
            ['name' => 'Auxiliar de Recursos Humanos'],
            ['name' => 'Auxiliar de Serviços Gerais'],
            ['name' => 'Auxiliar de Suporte Técnico'],
            ['name' => 'Auxiliar Financeiro(a)'],
            ['name' => 'Auxiliar Fiscal'],
            ['name' => 'Bibliotecário(a)'],
            ['name' => 'Biomédico(a)'],
            ['name' => 'Cabeleireiro(a)'],
            ['name' => 'Caixa'],
            ['name' => 'Consultor(a) Comercial'],
            ['name' => 'Consultor(a) de Negócios'],
            ['name' => 'Consultor(a) de Vendas'],
            ['name' => 'Contador(a)'],
            ['name' => 'Controller'],
            ['name' => 'Coordenador(a) de Atendimento'],
            ['name' => 'Coordenador(a) de Controladoria'],
            ['name' => 'Coordenador(a) de Marketing'],
            ['name' => 'Coordenador(a) de Produção'],
            ['name' => 'Coordenador(a) de Recursos Humanos'],
            ['name' => 'Coordenador(a) de Suporte Técnico'],
            ['name' => 'Coordenador(a) Financeiro(a)'],
            ['name' => 'Coordenador(a) Fiscal'],
            ['name' => 'Designer Gráfico'],
            ['name' => 'Economista'],
            ['name' => 'Eletricista'],
            ['name' => 'Engenheiro(a) Civil'],
            ['name' => 'Engenheiro(a) de Segurança do Trabalho'],
            ['name' => 'Engenheiro(a) Eletricista'],
            ['name' => 'Esteticista'],
            ['name' => 'Farmacêutico(a)'],
            ['name' => 'Fisioterapeuta'],
            ['name' => 'Fonoaudiólogo(a)'],
            ['name' => 'Gerente Administrativo(a)'],
            ['name' => 'Gerente Comercial'],
            ['name' => 'Gerente Contábil'],
            ['name' => 'Gerente de Atendimento'],
            ['name' => 'Gerente de Compras'],
            ['name' => 'Gerente de Controladoria'],
            ['name' => 'Gerente de Exportação'],
            ['name' => 'Gerente de Importação'],
            ['name' => 'Gerente de Logística'],
            ['name' => 'Gerente de Marketing'],
            ['name' => 'Gerente de Negócios'],
            ['name' => 'Gerente de Planejamento'],
            ['name' => 'Gerente de Produção'],
            ['name' => 'Gerente de Recursos Humanos'],
            ['name' => 'Gerente de Suporte Técnico'],
            ['name' => 'Gerente Financeiro(a)'],
            ['name' => 'Gerente Fiscal'],
            ['name' => 'Gestor(a) de Projetos'],
            ['name' => 'Médico(a)'],
            ['name' => 'Nutricionista'],
            ['name' => 'Operador(a) de Atendimento'],
            ['name' => 'Psicólogo(a)'],
            ['name' => 'Recepcionista'],
            ['name' => 'Secretário(a) Executivo(a)'],
            ['name' => 'Supervisor(a) Administrativo(a)'],
            ['name' => 'Supervisor(a) de Atendimento'],
            ['name' => 'Supervisor(a) de Compras'],
            ['name' => 'Supervisor(a) de Produção'],
            ['name' => 'Supervisor(a) de Recursos Humanos'],
            ['name' => 'Técnico(a) Administrativo(a)'],
            ['name' => 'Técnico(a) Contábil'],
            ['name' => 'Técnico(a) de Enfermagem'],
            ['name' => 'Técnico(a) de Manutenção'],
            ['name' => 'Técnico(a) de Segurança do Trabalho'],
            ['name' => 'Vendedor(a)'],
            ['name' => 'Zootecnista'],
        ];

        DB::table('occupations')->insert($occupations);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_areas');
    }
};
