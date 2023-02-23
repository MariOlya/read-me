<p align="center">
    <img src="public/web/img/Fotoram.io.png"
        width=172
        height=32 alt="readme"
    >
    <h1 align="center">readme: blog as it should be</h1>
    <h3 align="center">study project by Olga Marinina</h3>
</p>

<p align="center">
<img src="https://img.shields.io/badge/php-%5E8.2.0-blue">
<img src="https://img.shields.io/badge/PostgreSQL-15--alpine-blue">
<img src="https://img.shields.io/badge/Symfony-%5E6.2-lightgrey">

[//]: # (<img src="https://img.shields.io/badge/sphinx-latest-blue">)
[//]: # (<img src="https://img.shields.io/badge/phpunit-~9.5.0-blue">)
[//]: # (<img src="https://img.shields.io/badge/redis-5-red">)
</p>
<br>

The service gives users the opportunity to publish posts on their blog. The main feature of the service is the post format. When publishing, the user selects one of the five available post formats. This posting format is a cross between microblogging and full-blown, large blog posts.

Depending on the selected format, the user's post is formatted in a special way.

>The basis html, css, js were provided by online school 'HTML Academy', you can see their technical task in TODO.md (but only RU).

## Getting Started

Since I'm using [complete docker environment](https://github.com/dunglas/symfony-docker) by [Kévin Dunglas](https://dunglas.fr) here you should follow the recommendation to install:

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

To add all our composer dependencies, run `docker-compose run --rm php composer install`.

### Migrations

Just run `docker-compose run --rm php bin/console doctrine:migrations:migrate`.

### Fixtures

To add our prepared fake data, please, run `docker-compose run --rm php bin/console doctrine:fixtures:load`.
