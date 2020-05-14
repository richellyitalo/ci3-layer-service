# ci3-layer-service
Layer service para Codeigniter v3


## Pré-requisitos
Necessário `subclass_prefix` em `application/config/config.php` estar configurado com `MY_`:
```php
$config['subclass_prefix'] = 'MY_';
```

## Exemplo de uso

No controller, basta dar 'load' no serviço e executar o método necessário:
```php
// application/controllers/Sample.php

class Sample extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->service('sample_service');
    }

    public function save()
    {
        $res = $this->tarefa_service->salvar($this->input->post());

        if (!$res['sucesso']) {
            return response($res['mensagem'], false);
        }

        return response($res);
    }
}
```