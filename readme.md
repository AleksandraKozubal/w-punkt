## w punkt

### Local development
```
cp .env.example .env
make init
make dev
```
Application will be running under [localhost:43251](localhost:43251) and [http://w-punkt.localhost/](http://w-punkt.localhost/) in Blumilk traefik environment. If you don't have a Blumilk traefik environment set up yet, follow the instructions from this [repository](https://github.com/blumilksoftware/environment).

#### Commands
Before running any of the commands below, you must run shell:
```
make shell
```

| Command                 | Task                                        |
|:------------------------|:--------------------------------------------|
| `composer <command>`    | Composer                                    |
| `composer test`         | Runs backend tests                          |
| `composer analyse`      | Runs Larastan analyse for backend files     |
| `composer cs`           | Lints backend files                         |
| `composer csf`          | Lints and fixes backend files               |
| `php artisan <command>` | Artisan commands                            |
| `npm run dev`           | Compiles and hot-reloads for development    |
| `npm run build`         | Compiles and minifies for production        |
| `npm run lint`          | Lints frontend files                        |
| `npm run lintf`         | Lints and fixes frontend files              |
| `npm run tsc`           | Runs TypeScript checker                     |


#### Containers

| service    | container name        | default host port               |
|:-----------|:----------------------|:--------------------------------|
| `app`      | `w-punkt-app-dev`     | [43251](http://localhost:43251) |
| `database` | `w-punkt-db-dev`      | 43253                           |
| `redis`    | `w-punkt-redis-dev`   | 43252                           |
| `mailpit`  | `w-punkt-mailpit-dev`        | 43254                           |
