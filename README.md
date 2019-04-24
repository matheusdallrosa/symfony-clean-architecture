symfony-clean-architecture
==========================

This project is an attempt to use the Clean Architecture 
on an application for managing music. 

I've made an [UML diagram](https://drive.google.com/file/d/1p9PqT0Gi2mxGQcs3BLCn_fNRWkHjr8vT/view) to have
an overview of the big picture for the CreateMusicUseCase and FindMusicUseCase use cases.

##### The app is using Symfony 3.4 to manage details like:
- HTTP Request / Response
- Routing
- Persistence

##### Steps to use the system in dev mode:

     docker-compose up
Inside the php-fpm container make:
 
     php bin/console doctrine:schema:create
     chmod 777 var/data/data.sqlite 

##### Tests
    ./vendor/bin/simple-phpunit 

##### Routes:

```
POST http://127.0.0.1:8080/music

body:
{
    "durationInSeconds": 267,
    "title": "Ize Of The World",
    "lyrics": "I think i know what you mean but watch what you say...."
}
```

```
GET http://127.0.0.1:8080/music/{id}
```

```
DELETE http://127.0.0.1:8080/music/{id}
```