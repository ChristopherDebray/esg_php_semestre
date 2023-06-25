<?php
namespace App\models;
use App\core\ORM;

class Reporting extends ORM {
    protected $id = -1;
    protected $date_inserted;
    protected $date_updated;
    protected $page_id;
    protected $comment_id;
    protected $status = 1;

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
     * @return Integer
     */
    public function getDateUpdated(): Int
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
    public function getComment()
    {
        return $this->comment_id;
    }

    public function setComment($comment_id)
    {
        $this->comment_id = $comment_id;
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
}
