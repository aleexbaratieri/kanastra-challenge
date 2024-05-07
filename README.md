```sh
git clone git@github.com:aleexbaratieri/kanastra-chalange.git

#create envs
cp .env.example .env

# inicialize containers
docker-compose up -d

#configure api
cp api/.env.example api/.env

#set vars
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_username_password

QUEUE_CONNECTION=redis

REDIS_CLIENT=predis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

docker-compose exec api composer install
docker-compose exec api php artisan key:generate
docker-compose exec api php artisan migrate
```

#### Edit docker-compose file if you need change ports
API: [http://localhost:8000](http://localhost:8000)
APP: [http://localhost](http://localhost)