<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as FOSUser;

class User extends FOSUser
{
    protected $id;

    /**
     * @var ArrayCollection
     */
    private $assignedTasks;

    public function __construct()
    {
        parent::__construct();
        $this->assignedTasks = new ArrayCollection();
    }

    public function isAssignedToTask($task)
    {
        return $this->assignedTasks->contains($task);
    }

    public function getNbOfAssignedTasks()
    {
        return $this->assignedTasks->count();
    }

    public function assignTo($task)
    {
        if (!$this->assignedTasks->contains($task)) {
            $this->assignedTasks->add($task);
        }
    }
}
