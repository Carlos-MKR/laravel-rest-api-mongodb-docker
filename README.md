<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# API REST - Laravel + MongoDB

<p align="center">
  <a href="https://youtu.be/1hLWcHHmY20">
    <img src="https://img.shields.io/badge/Demo-YouTube-red?style=for-the-badge&logo=youtube" />
  </a>
</p>

API RESTful desarrollada con Laravel y MongoDB para la gestión de categorías y posts.
---

## ⚙️ Requisitos Previos

- Docker
- Docker Compose
- Composer

O alternativamente:
- PHP 8+
- MongoDB
- Composer

---

## 🚀 Instalación

### 1️. Clonar el repositorio

```bash
git clone https://github.com/Carlos-MKR/laravel-rest-api-mongodb-docker.git
cd laravel
```

### 2. Configurar entorno
Copiar el archivo de ejemplo:
```bash
cp .env.example .env
```
Configurar variables para conexión a MongoDB:
```bash
DB_CONNECTION=mongodb
DB_HOST=laravel-mongodb
DB_PORT=27017
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=example
```
### 3. Levantar contenedores Docker
Asegúrate de tener Docker Desktop abierto.
Navega hacia la raiz de la carpeta clonada:
```bash
cd laravel-rest-api-mongodb-docker
```
Levantar contenedores
```bash
docker compose up --build -d
```
Navega hacia la carepta del proyecto:
```bash
cd laravel
```
Ejecuta:
```bash
docker exec -it laravel-app bash
composer install
php artisan key:generate
php artisan migrate
```
---
#### Acceder al Proyecto
Una vez iniciado correctamente:
```bash
http://localhost:8080
```
La API estará disponible en:
```bash
http://localhost:8080/api
```

