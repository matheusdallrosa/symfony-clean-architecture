<?php

namespace AppBundle\Music;

use AppBundle\Common\ConstraintViolationFormatter;
use Mus\Music\DataTransferObject\CreateMusicRequestDto;
use Mus\Music\DataTransferObject\MusicFoundResponseDto;
use Mus\Music\Exception\InvalidMusicDataException;

use Mus\Music\Exception\MusicNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MusicController
{
    /**
     * @Route(path = "/music", methods = "POST")
     */
    public function createMusicAction(
        Request $request,
        ValidatorInterface $validator,
        MusicService $musicService
    ): Response
    {
        $requestData = \json_decode($request->getContent(), true);

        $violations = $validator->validate(new MusicDataStructureValidation($requestData));
        if(count($violations) > 0){
            return new Response(
                json_encode(ConstraintViolationFormatter::format($violations)),
                Response::HTTP_BAD_REQUEST,
                [
                    'content-type' => 'application/json'
                ]
            );
        }

        $createMusicRequestDto = CreateMusicRequestDto::fromArray($requestData);

        try{
            $createMusicResponseDto = $musicService->createMusic($createMusicRequestDto);
        }catch(InvalidMusicDataException $e){
            return new Response(
                json_encode(
                    [
                        'reasons' => $e->getViolations()
                    ]
                ),
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'content-type' => 'application/json'
                ]
            );
        }

        return new Response(
            json_encode($createMusicResponseDto->toArray()),
            Response::HTTP_CREATED,
            [
                'content-type' => 'application/json'
            ]
        );
    }

    /**
     * @Route(
     *     path = "/music/{id}",
     *     methods = "GET",
     *     requirements={"id"="\d+"}
     * )
     */
    public function findMusicByIdAction(
        int $id,
        MusicService $musicService
    ): Response
    {
        try{
            $musicFoundResponseDto = $musicService->findMusicById($id);
        }catch(MusicNotFoundException $e) {
            return new Response(
                '',
                Response::HTTP_NOT_FOUND
            );
        }

        return new Response(
            json_encode($musicFoundResponseDto->toArray(), true),
            Response::HTTP_OK,
            [
                'content-type' => 'application/json'
            ]
        );
    }

    /**
     * @Route(
     *     path = "/music/{id}",
     *     methods = "DELETE",
     *     requirements={"id"="\d+"}
     * )
     */
    public function removeMusicByIdAction(
        int $id,
        MusicService $musicService
    ): Response
    {
        try{
            $musicService->removeMusicById($id);
        }catch(MusicNotFoundException $e){
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}