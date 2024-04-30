# Utiliser une image PHP avec Apache
FROM php:8.2-apache

# Copier le fichier de configuration Apache
RUN apt-get update && apt-get install -y 
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql


# Exposer le port sur lequel Apache est configuré pour écouter
EXPOSE 80
