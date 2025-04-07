<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditObserver
{
    public function created($model)
    {
        $this->log('created', $model);
    }

    public function updated($model)
    {
        $this->log('updated', $model);
    }

    public function deleted($model)
    {
        $this->log('deleted', $model);
    }

    protected function log($action, $model)
    {
        $changes = $model->getChanges();
        $translatedChanges = [];

        foreach ($changes as $key => $value) {
            $translatedKey = $this->translateAttribute($key);
            $translatedChanges[$translatedKey] = $value;
        }

        DB::table('audit_logs')->insert([
            'user_id' => Auth::id() ?? null,
            'event' => $action,
            'entity_type' => get_class($model),
            'entity_id' => $model->id,
            'entity_name' => $model->name ?? 'Desconhecido',
            'changes' => json_encode($translatedChanges),
            'ip_address' => Request::ip() ?? 'N/A',
            'user_agent' => Request::header('User-Agent') ?? 'Desconhecido',
            'created_at' => now(),
        ]);
    }

    protected function translateAttribute($attribute)
    {
        $translations = [
            'account' => 'Conta',
            'account_check_digit' => 'Dígito Verificador Da Conta',
            'address' => 'Endereço',
            'agency' => 'Agência',
            'amount' => 'Quantia',
            'anonymous' => 'Anônimo',
            'attempts' => 'Tentativas',
            'biography' => 'Biografia',
            'billing_cycle' => 'Ciclo De Faturamento',
            'birdthdate' => 'Data De Nascimento',
            'brand' => 'Marca',
            'caused' => 'Causa',
            'canceled_at' => 'Cancelado Em',
            'changes' => 'Mudanças',
            'city' => 'Cidade',
            'client_id' => 'ID Do Cliente',
            'closed_at' => 'Fechado Em',
            'complement' => 'Complemento',
            'connection' => 'Conexão',
            'country' => 'País',
            'cpf_cnpj' => 'CPF/CNPJ',
            'created_at' => 'Criado Em',
            'credit_card_token' => 'Token Do Cartão De Crédito',
            'customer_id' => 'ID Do Cliente',
            'data' => 'Dados',
            'date' => 'Data',
            'deleted_at' => 'Excluído Em',
            'description' => 'Descrição',
            'duration' => 'Duração',
            'due_date' => 'Data De Vencimento',
            'email' => 'Email',
            'end_date' => 'Data De Término',
            'end_time' => 'Hora De Término',
            'entity_id' => 'ID Da Entidade',
            'entity_name' => 'Nome Da Entidade',
            'entity_type' => 'Tipo Da Entidade',
            'exception' => 'Exceção',
            'expires_at' => 'Expira Em',
            'features' => 'Recursos',
            'failed_at' => 'Falhou Em',
            'file' => 'Arquivo',
            'folder_path' => 'Caminho Da Pasta',
            'from_user_id' => 'ID Do Usuário De Origem',
            'guard_name' => 'Nome Do Guardião',
            'hash' => 'Hash',
            'ip_address' => 'Endereço IP',
            'is_active' => 'Está Ativo',
            'key' => 'Chave',
            'key_type' => 'Tipo De Chave',
            'last_activity' => 'Última Atividade',
            'last_digits' => 'Últimos Dígitos',
            'last_use' => 'Último Uso',
            'model_id' => 'ID Do Modelo',
            'model_type' => 'Tipo De Modelo',
            'name' => 'Nome',
            'neighborhood' => 'Bairro',
            'number' => 'Número',
            'occupation_id' => 'ID Da Ocupação',
            'owner_birth_date' => 'Data De Nascimento Do Proprietário',
            'owner_name' => 'Nome Do Proprietário',
            'password' => 'Senha',
            'payload' => 'Carga Útil',
            'payment_id' => 'ID Do Pagamento',
            'permission_id' => 'ID Da Permissão',
            'phone' => 'Telefone',
            'plan_id' => 'ID Do Plano',
            'price' => 'Preço',
            'priority' => 'Prioridade',
            'professional_documents_id' => 'ID Dos Documentos Profissionais',
            'professional_id' => 'ID Do Profissional',
            'profit_tax' => 'Imposto Sobre Lucro',
            'protocol' => 'Protocolo',
            'queue' => 'Fila',
            'rating' => 'Classificação',
            'read_at' => 'Lido Em',
            'reason' => 'Razão',
            'recording_id' => 'ID Da Gravação',
            'remote_ip' => 'IP Remoto',
            'renewal_date' => 'Data De Renovação',
            'resolution' => 'Resolução',
            'response' => 'Resposta',
            'review_id' => 'ID Da Avaliação',
            'comment' => 'Texto Da Avaliação',
            'role_id' => 'ID Do Papel',
            'room_id' => 'ID Da Sala',
            'severity' => 'Gravidade',
            'start_date' => 'Data De Início',
            'start_time' => 'Hora De Início',
            'start_ts' => 'Timestamp De Início',
            'state' => 'Estado',
            'status' => 'Status',
            'street' => 'Rua',
            'subject' => 'Assunto',
            'support_agent_id' => 'ID Do Agente De Suporte',
            'support_categories_id' => 'ID Da Categoria De Suporte',
            'token' => 'Token',
            'to_user_id' => 'ID Do Usuário De Destino',
            'trial_end_date' => 'Data De Término Do Teste',
            'trial_period_days' => 'Dias De Período De Teste',
            'type' => 'Tipo',
            'updated_at' => 'Atualizado Em',
            'url' => 'URL',
            'used' => 'Usado',
            'user_agent' => 'Agente Do Usuário',
            'user_id' => 'ID Do Usuário',
            'uuid' => 'UUID',
        ];

        return $translations[$attribute] ?? $attribute;
    }
}
