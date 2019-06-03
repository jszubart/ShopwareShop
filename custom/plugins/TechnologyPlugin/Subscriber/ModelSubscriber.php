<?php

namespace TechnologyPlugin\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Shopware\Components\Model\ModelManager;
use TechnologyPlugin\Models\Technology;


class ModelSubscriber implements EventSubscriber
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    /**
     * @param LifecycleEventArgs $arguments
     */
    public function postPersist(LifecycleEventArgs $arguments)
    {
        /** @var ModelManager $modelManager */
        $modelManager = $arguments->getEntityManager();
        $model = $arguments->getEntity();

        if(!$model instanceof Technology) {
            return;
        }

        $name = strtolower(rtrim($model->getName()));

        $model->setUrl(str_replace(" ","-", $name));
        $modelManager->flush();
    }

    /**
     * @param LifecycleEventArgs $arguments
     */
    public function postUpdate(LifecycleEventArgs $arguments)
    {
        /** @var ModelManager $modelManager */
        $modelManager = $arguments->getEntityManager();
        $model = $arguments->getEntity();

        if(!$model instanceof Technology) {
            return;
        }

        $name = strtolower(rtrim($model->getName()));

        $model->setUrl(str_replace(" ","-", $name));
        $modelManager->persist($model);
        $modelManager->flush();
    }
}