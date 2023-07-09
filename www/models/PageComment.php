<?php
namespace App\models;
use App\core\ORM;
use App\models\Reporting;

class PageComment extends ORM {
    protected $id = -1;
    protected $date_inserted;
    protected $status = 1;
    protected $content;
    protected $page_id;
    protected $user_id;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;

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
        $this->content = htmlspecialchars(trim($content));
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page_id;
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
        return $this->user_id;
    }

    public function setUser($user_id)
    {
        $this->user_id = $user_id;
    }

    public function isVerified()
    {
        $reporting = new Reporting();
        return $reporting::getOneBy(['comment_id' => $this->getId(), 'status' => Reporting::STATUS_REVIEWED]);
    }

    public function isSignaled()
    {
        $reporting = new Reporting();
        return $reporting::getOneBy(['comment_id' => $this->getId(), 'status' => Reporting::STATUS_ACTIVE]);
    }
}
