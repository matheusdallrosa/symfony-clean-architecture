<?php

namespace Mus\Music;

use Mus\Music\Entity\Music;
use Mus\Music\Exception\MusicNotFoundException;
use Mus\Music\Gateway\MusicAccessGateway;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Compiler\RemoveUnusedDefinitionsPass;

class RemoveMusicUseCaseTest extends TestCase
{
    public function testShouldReceiveAMusicNotFoundException(): void
    {
        $mockedMusicAccessGateway = $this->getMockBuilder(MusicAccessGateway::class)
            ->setMethods(['save', 'findById', 'remove'])
            ->getMock();

        $id = 1;
        $mockedMusicAccessGateway->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willThrowException(new MusicNotFoundException());

        $this->expectException(MusicNotFoundException::class);

        $removeMusicUseCase = new RemoveMusicUseCase($mockedMusicAccessGateway);
        $removeMusicUseCase->removeById($id);
    }

    public function testShouldUseTheCorrectMethodsToRemoveAMusicById(): void
    {
        $mockedMusicAccessGateway = $this->getMockBuilder(MusicAccessGateway::class)
            ->setMethods(['save', 'findById', 'remove'])
            ->getMock();

        $id = 1;
        $duration = 142;
        $title = "test song";
        $lyrics = "test lyrics for the test song";

        $music = new Music($duration, $title, $lyrics);
        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, $id);

        $mockedMusicAccessGateway->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($music);

        $mockedMusicAccessGateway->expects($this->once())
            ->method('remove')
            ->with($this->isInstanceOf(Music::class));

        $removeMusicUseCase = new RemoveMusicUseCase($mockedMusicAccessGateway);
        $removeMusicUseCase->removeById($id);
    }
}