<?php


namespace AppBundle\Music;

use Mus\Music\Entity\Music;
use Mus\Music\Gateway\MusicAccessGateway;

class MusicAccess implements MusicAccessGateway {

    public function save(Music $music): Music
    {
        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, 1);
        return $music;
    }

    public function findById(int $id): ?Music
    {
        if($id !== 1){
            return null;
        }
        $music = new Music(
            1,
            "Stella was a diver and she was always down",
            "She was alright but she sea was so airtight, she broke away..."
        );
        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, 1);
        return $music;
    }
}
