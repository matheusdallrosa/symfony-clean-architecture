<?php


namespace AppBundle\Music;

use Doctrine\ORM\EntityManagerInterface;
use Mus\Music\Entity\Music;
use Mus\Music\Gateway\MusicAccessGateway;

class MusicAccess implements MusicAccessGateway {

    private $entityManager;

    private $musicRepository;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->musicRepository = $entityManager->getRepository(Music::class);
    }

    public function save(Music $music): Music
    {
        $this->entityManager->persist($music);

        $this->entityManager->flush();

        return $music;
    }

    public function findById(int $id): ?Music
    {
        return $this->musicRepository->findOneBy([ 'id' => $id ]);
    }

    public function remove(Music $music): void
    {
        $this->entityManager->remove($music);
        $this->entityManager->flush();
    }

}
