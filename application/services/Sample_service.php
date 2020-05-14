<?php
class Sample_service extends MY_Service
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('sample_model');
    }

    public function salvar($data)
    {
        try {
            $rules = [
                [
                    'field' => 'id',
                    'label' => 'Oportunidade',
                    'rules' => 'required'
                ],
                [
                    'field' => 'tipo',
                    'label' => 'Tipo',
                    'rules' => 'required'
                ],
                [
                    'field' => 'descricao',
                    'label' => 'Descrição',
                    'rules' => 'required'
                ]
            ];
            $valido = $this->form_validation->set_data($data)->set_rules($rules)->run();
            if (!$valido) {
                throw new Exception(validation_errors());
            }

            if (empty($data['prazo'])) {
                $data['prazo'] = date('Y-m-d H:i:s');
                $data['finalizacao'] = date('Y-m-d  H:i:s');
            }

            $tarefa = $this->tarefa_model->save($data);
            return [
                'sucesso' => true,
                'mensagem' => 'Tarefa cadastrada com sucesso',
                'data' => $tarefa
            ];
        } catch (Exception $e) {
            return [
                'sucesso' => false,
                'mensagem' => $e->getMessage(),
                'data' => null
            ];
        }
    }
}
