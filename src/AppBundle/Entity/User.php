<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as FOSUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends FOSUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Task", mappedBy="assignedTo")
     */
    private $assignedTasks;

    public function __construct() {
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
}
