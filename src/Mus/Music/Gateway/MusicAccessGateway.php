<?php

namespace Mus\Music\Gateway;

use Mus\Music\Entity\Music;

interface MusicAccessGateway {
    public function save(Music $music) : Music;

    public function findById(int $id): ?Music;

    public function remove(Music $music): void;
}