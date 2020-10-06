<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PageToCheck;
use App\Entity\Results;

class Check
{

    private EntityManagerInterface $em;
    private GetContent $getContent;
    private SendNotification $sendNotification;

    public function __construct(
        EntityManagerInterface $em,
        GetContent $getContent,
        SendNotification $sendNotification
    )
    {
        $this->em               = $em;
        $this->getContent       = $getContent;
        $this->sendNotification = $sendNotification;
    }

    public function run()
    {
        //TODO do not use getAll() think about logic
        $pages = $this->em->getRepository(PageToCheck::class)->findAll();
        foreach ($pages as $page) {
            $contents = $this->getContent->get($page->getUrl(), $page->getFilter());
            $results  = $this->em->getRepository(Results::class)->findBy(
                [
                    'pageId' => $page->getId(),
                ]
            );

            if ( ! $results) {
                $this->saveResults($page, $contents);
            } else {
                foreach ($results as $i => $result) {
                    if ($contents[$i] !== $result->getBody()) {
                        $this->saveResult($page, $contents[$i], $i);

                        //todo send alerts
                        $this->sendNotification->send();
                    }
                }
            }
        }
    }

    private function saveResults(PageToCheck $page, array $contents)
    {
        foreach ($contents as $i => $content) {
            $result = new Results();
            $result->setPageId($page);
            $result->setRow($i);
            $result->setBody($content);
            $result->setDate(new \DateTime());
            $this->em->persist($result);
        }

        $this->em->flush();
    }

    private function saveResult(PageToCheck $page, string $content, int $row)
    {
        $result = new Results();
        $result->setPageId($page);
        $result->setRow($row);
        $result->setBody($content);
        $result->setDate(new \DateTime());
        $this->em->persist($result);
        $this->em->flush();
    }

}
