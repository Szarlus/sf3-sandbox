<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class ORMTaskRepository extends EntityRepository
{
    public function findAllDoneInCategory(Category $category)
    {
        return $this->findBy(
            ['category' => $category, 'status' => 'done'],
            ['dueDate' => 'ASC']
        );
    }
}