<?php
namespace App\Forms;

use App\core\Validator;

class UpdateUser extends Validator {
    public $config = [];
    public $method = "POST";
    public $statusOptions = [
        ["label"=>"STATUS_INACTIVE", "value"=>0],
        ["label"=>"STATUS_ACTIVE", "value"=>1],
        ["label"=>"STATUS_BANNED", "value"=>2]
    ];
    public $roleOptions = [
        ["label"=>"admin", "value"=>"admin"],
        ["label"=>"suscriber", "value"=>"suscriber"],
        ["label"=>"guest", "value"=>"guest"]
    ];
    public $user = null;

    public function __construct($user)
    {
        $this->user=$user;
        $this->config = [
            "config"=>[
                "method"=>$this->method,
                "title"=>"Modifier l'utilisateur",
                "action"=>"",
                "class"=>"col-6",
                "id"=>"form-update-user",
                "submit"=>"Modifier l'utilisateur",
                "cancel"=>"Annuler",
                "redirectIfCancel"=>"dashboard"
            ],
            "inputs"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Prénom",
                    "required"=>true,
                    "id"=>"firstname",
                    "class"=>null,
                    "error"=>"Prénom incorrect",
                    "value"=>$user->getFirstname()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom",
                    "required"=>true,
                    "id"=>"lastname",
                    "class"=>null,
                    "error"=>"Nom incorrect",
                    "value"=>$user->getLastname()
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true,
                    "id"=>"input-email",
                    "class"=>null,
                    "error"=>"Votre email est incorrect",
                    "value"=>$user->getEmail()
                ],
                "status"=>[
                    "type"=>"select",
                    "options"=>$this->statusOptions,
                    "id"=>"status",
                    "name"=>"status",
                    "value"=>$this->getStatusDefaultValue(),
                    "label"=>$this->getStatusDefaultLabel(),
                ],
                "role"=>[
                    "type"=>"select",
                    "options"=>$this->roleOptions,
                    "id"=>"role",
                    "name"=>"role",
                    "label"=>$this->getRoleDefaultLabel(),
                    "value"=>$this->getRoleDefaultValue()
                ],
            ]
        ];

        parent::__construct();
    }

    public function getStatusDefaultValue()
    {
        $statusDefaultValue = array_search($this->user->getStatus(), array_column($this->statusOptions, 'value'));
        return $this->statusOptions[$statusDefaultValue]["value"];
    }

    public function getStatusDefaultLabel()
    {
        $statusDefaultLabel = array_search($this->user->getStatus(), array_column($this->statusOptions, 'label'));
        return $this->statusOptions[$statusDefaultLabel]["label"];
    }

    public function getRoleDefaultValue()
    {
        $roleDefaultValue = array_search($this->user->getRole(), array_column($this->roleOptions, 'value'));
        return $this->roleOptions[$roleDefaultValue]["value"];
    }

    public function getRoleDefaultLabel()
    {
        $roleDefaultValue = array_search($this->user->getRole(), array_column($this->roleOptions, 'value'));
        return $this->roleOptions[$roleDefaultValue]["label"];
    }

    public function getConfig(): array
    {
        return $this->config;
    }

}