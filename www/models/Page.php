<?php
namespace App\models;
use App\core\ORM;
use App\core\Security;

class Page extends ORM {
    protected $id = -1;
    protected $title;
    protected $slug;
    protected $content;
    protected $config;
    protected $theme;
    protected $status = 1;
    protected $date_inserted;
    protected $date_updated;
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
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
     * @return int
     */
    public function getUser()
    {
        return $this->user_id;
    }

    public function setUser($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = htmlspecialchars(trim($title));
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = str_replace(" ","_", htmlspecialchars(strtolower(trim($slug))));
    }

    /**
     * @return mixed
     */
    public function getContent(): mixed
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent(mixed $content): void
    {
        $this->content = Security::removeStringScriptTag(trim($content));
    }

    /**
     * @return mixed
     */
    public function getConfig(): mixed
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig(mixed $config): void
    {
        $this->config = Security::removeStringScriptTag(trim($config));
    }

    /**
     * @return Integer
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
     * @return Integer
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
    public function getTheme(): int
    {
        return $this->theme;
    }

    /**
     * @param int $theme
     */
    public function setTheme(int $theme): void
    {
        $this->theme = $theme;
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

    public function getContentAsArray(): array
    {
        return get_object_vars(json_decode($this->content));
    }

    public function getConfigAsArray(): array
    {
        return get_object_vars(json_decode($this->config));
    }

    public function isPageActive(): bool
    {
        return $this->status == 1;
    }
}
