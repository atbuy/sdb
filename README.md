# Special Database Topics Semester's Excerise

The exercise contains SQL files to load a database according to the given instructions in the exercise.

A docker container starts, the volumes add the necessary SQL files to the MariaDB's entrypoint.
The database is now active and you can preview it, either with a database tool or just by connecting to the container.

## Installation

You simply have to use `docker` to start the database.

```bash
docker compose up --build -d
```

## Usage

You can preview the database with a tool like [DBeaver](https://dbeaver.io/), or just by connecting to the container manually.

```bash
$ docker exec -it specdb bash
$ mariadb -uroot -ppassword specdb
MariaDB [specdb]> show tables;
```
