<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;


/**
 * @AppAssert\TasksLimitNotReached
 */
class Task
{
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min = 3)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var ArrayCollection
     */
    private $tags;

    /**
     * @var \DateTime
     */
    private $dueDate;

    /**
     * @var User
     */
    private $assignedTo;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \SplFileObject
     */
    private $file;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->status = 'todo';
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param \DateTime $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @return User
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * @param User $assignedTo
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo = $assignedTo;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \SplFileInfo
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \SplFileInfo $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function beginWork()
    {
        $this->status = 'in_progress';
    }

    public function finishWork()
    {
        $this->status = 'done';
    }

    public function isStarted()
    {
        return $this->status == 'in_progress';
    }

    public function isFinished()
    {
        return $this->status == 'done';
    }
}