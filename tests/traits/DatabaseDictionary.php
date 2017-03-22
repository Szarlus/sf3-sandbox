<?php

namespace tests\traits;


use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

trait DatabaseDictionary
{
    protected function persist($entity)
    {
        $this->entityManager()->persist($entity);
    }

    protected function flush()
    {
        $this->entityManager()->flush();
    }

    protected function save($entity)
    {
        $this->persist($entity);
        $this->flush();
    }

    protected function saveAll($entities)
    {
        foreach ($entities as $entity) {
            $this->persist($entity);
        }

        $this->flush();
    }

    protected function purgeDatabase()
    {
        $purger = new ORMPurger($this->entityManager());

        $purger->purge();
    }

    /**
     * @return EntityManager
     */
    protected function entityManager()
    {
        return $this->container()->get('doctrine.orm.entity_manager');
    }

    /**
     * @return EntityRepository
     */
    protected function repository($entityName)
    {
        $this->entityManager()->getRepository($entityName);
    }
}