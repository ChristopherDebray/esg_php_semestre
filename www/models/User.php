<?php
namespace App\models;
use App\core\ORM;
use App\services\StringFormatterService;

class User extends ORM {

    protected $id = -1;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $date_inserted;
    protected $date_updated;
    protected $status = 0;
    protected $role;
    protected $token;
    protected $is_verified = 0;

    const ROLE_ADMIN     = "admin";
    const ROLE_SUSCRIBER = "suscriber";
    const ROLE_GUEST     = "guest";

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;

    public function __construct()
    {
        parent::__construct();
        $this->role = self::ROLE_GUEST;
        $this->setDateInserted(time());
        $this->setDateUpdated(time());
    }

    public function __toString(): string
    {
        return serialize($this);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = htmlspecialchars(ucwords(strtolower(trim($firstname))));
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = htmlspecialchars(strtoupper(trim($lastname)));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = htmlspecialchars(strtolower(trim($email)));
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return String
     */
    public function getDateInserted(): string
    {
        return $this->date_inserted;
    }

    /**
     * @param Integer $date_inserted
     */
    public function setDateInserted(Int $date_inserted): void
    {
        if(!$this->date_inserted) {
            $this->date_inserted = date("Y-m-d h:i:s", $date_inserted);
        }
    }

    /**
     * @return String
     */
    public function getDateUpdated(): string
    {
        return $this->date_updated;
    }

    /**
     * @param Integer $date_updated
     */
    public function setDateUpdated(Int $date_updated): void
    {
        $this->date_updated = date("Y-m-d h:i:s", $date_updated);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param array $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getRolePermissionLevel(): int
    {
        $rolePermissionLevel = 1;
        switch ($this->role) {
            case self::ROLE_ADMIN:
                $rolePermissionLevel++;
            case self::ROLE_SUSCRIBER:
                $rolePermissionLevel++;
                break;
        }

        return $rolePermissionLevel;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getIsVerified(): int
    {
        return $this->is_verified;
    }

    /**
     * @param int $is_verified
     */
    public function setIsVerified(int $is_verified): void
    {
        $this->is_verified = $is_verified;
    }
}