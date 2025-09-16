sudo docker exec -it greenbiller_php bash
sudo docker exec -it greenbiller_mysql mysql -u greenbiller_user -p

1️⃣ Change ownership of your project to your user
sudo chown -R hp:hp /home/hp/Documents/GitHub/DOCKER/greenbiller_php_docker/greenbiller_app

2️⃣ Change permissions of the migrations folder
sudo chmod -R 775 /home/hp/Documents/GitHub/DOCKER/greenbiller_php_docker/greenbiller_app/database/migrations

drop all tables :: php artisan migrate:fresh