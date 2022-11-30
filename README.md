## Installation

```bash
git clone https://github.com/MishaNahapetyan/gorest-test.git
```

```bash
cd gorest-test
```

Copy .env file:
```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

Add gorest's api token and url.
```dotenv
API_URL=https://gorest.co.in/
API_TOKEN=
```

```bash
composer install
```

```bash
./vendor/bin/sail up
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

Url `http://127.0.0.1`
