<?php
namespace App\models;
use App\core\ORM;

class PageComment extends ORM {
    protected $id = -1;
    protected $date_inserted;
    protected $status = 1;
    protected $content;
    protected $page_id;
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->setDateInserted(time());
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
     * @return Integer
     */
    public function getDateInserted(): int
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
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = trim($content);
    }

    /**
     * @return int
     */
    public function getPage()
    {
        $this->page_id;
    }

    public function setPage($page_id)
    {
        $this->page_id = $page_id;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        $this->user_id;
    }

    public function setUser($user_id)
    {
        $this->user_id = $user_id;
    }
}
