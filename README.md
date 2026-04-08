<div align="center">

<img src="public/img/logoSenaProyect3.png" alt="SENA Contigo Logo" width="200"/>

# 🎓 SENA Contigo
### Plataforma de Apoyo y Retención de Aprendices

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![MVC](https://img.shields.io/badge/Patr%C3%B3n-MVC-green?style=for-the-badge)](https://en.wikipedia.org/wiki/Model–view–controller)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)
[![Version](https://img.shields.io/badge/Versi%C3%B3n-1.0-blue?style=for-the-badge)](https://github.com/tu-usuario/sena-contigo)

*Sistema Integral de Prevención a la Deserción Estudiantil — SENA CPIC*

[🚀 Demo en vivo](#) · [📋 Documentación](#documentación) · [🐛 Reportar bug](../../issues) · [💡 Solicitar feature](../../issues)

</div>

---

## 📌 Tabla de Contenidos

- [Sobre el Proyecto](#-sobre-el-proyecto)
- [Problema que Resuelve](#-problema-que-resuelve)
- [Funcionalidades](#-funcionalidades)
- [Arquitectura](#-arquitectura)
- [Tecnologías Usadas](#-tecnologías-usadas)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación y Configuración](#-instalación-y-configuración)
- [Variables de Entorno](#️-variables-de-entorno)
- [Base de Datos](#-base-de-datos)
- [Seguridad](#-seguridad)
- [Despliegue](#-despliegue)
- [Equipo](#-equipo)

---

## 🎯 Sobre el Proyecto

**SENA Contigo** es una plataforma web desarrollada para el **Centro de Procesos Industriales y Construcción (CPIC)** del SENA, cuyo objetivo es **mejorar la retención de aprendices** mediante la detección temprana de señales de riesgo de deserción y el seguimiento detallado del progreso estudiantil en tiempo real.

El sistema permite a instructores, coordinadores y profesionales de bienestar identificar, registrar e intervenir oportunamente a aquellos aprendices que presentan factores de riesgo, fortaleciendo así el acompañamiento pedagógico y la permanencia en los programas de formación.

> 💡 **Desarrollado como proyecto formativo** en el marco del programa del SENA, este sistema es una solución real orientada a impactar positivamente la comunidad educativa del CPIC.

---

## 🔍 Problema que Resuelve

La deserción estudiantil en los programas formativos del SENA impacta negativamente la calidad del proceso educativo y la efectividad institucional. Los aprendices abandonan sus programas técnicos y tecnológicos sin completar las competencias laborales requeridas, reduciendo su empleabilidad y desaprovechando la inversión en educación para el trabajo.

**SENA Contigo** aborda esta problemática con:

- ✅ Detección temprana de riesgo de deserción
- ✅ Seguimiento en tiempo real del progreso estudiantil
- ✅ Registro de intervenciones y estrategias de apoyo
- ✅ Reportes y dashboards para la toma de decisiones institucionales
- ✅ Comunicación directa con aprendices mediante correo electrónico

---

## ✨ Funcionalidades

### 👥 Gestión de Usuarios y Roles

| Rol | Descripción |
|---|---|
| 🔴 **Administrador** | Gestión completa del sistema, usuarios y configuración |
| 🟠 **Coordinador** | Supervisión de programas, grupos y reportes globales |
| 🟡 **Instructor** | Seguimiento de aprendices y registro de observaciones |
| 🟢 **Profesional de Bienestar** | Gestión de intervenciones y estrategias de apoyo |
| 🔵 **Aprendiz Vocero** | Acceso a información y seguimiento de su grupo |

### 📋 Módulos del Sistema

- **Gestión de Aprendices** — Registro, seguimiento y estado de cada aprendiz
- **Programas y Grupos** — Administración de fichas, programas técnicos y tecnológicos
- **Detección de Riesgo** — Identificación de causas y categorías de riesgo de deserción
- **Intervenciones** — Registro y seguimiento de estrategias aplicadas
- **Reportes** — Generación de informes con métricas clave de retención
- **Importación de Excel** — Carga masiva de datos de aprendices desde archivos `.xlsx`
- **Notificaciones por Email** — Envío de alertas y comunicados a aprendices e instructores
- **Autenticación Segura** — Login con control de sesiones y recuperación de contraseña

---

## 🏗 Arquitectura

El sistema implementa el patrón de arquitectura **MVC (Modelo — Vista — Controlador)**, lo que permite una organización estructurada del código, facilitando la escalabilidad, mantenibilidad y reutilización del software.

```
┌─────────────────────────────────────────────────────────┐
│                     NAVEGADOR WEB                       │
│              (Solicitudes HTTP del usuario)             │
└──────────────────────────┬──────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────┐
│              SERVIDOR WEB (Apache / PHP)                │
│                public/index.php (Front Controller)      │
└────────────┬────────────────────────────┬───────────────┘
             │                            │
             ▼                            ▼
┌────────────────────┐        ┌───────────────────────────┐
│   CONTROLADORES    │◄──────►│         MODELOS           │
│  (app/controllers) │        │      (app/models)         │
│                    │        │  Lógica de negocio / CRUD │
└────────────┬───────┘        └──────────────┬────────────┘
             │                               │
             ▼                               ▼
┌────────────────────┐        ┌───────────────────────────┐
│      VISTAS        │        │    BASE DE DATOS          │
│   (app/views)      │        │      PostgreSQL           │
│  Interfaz HTML/CSS │        │                           │
└────────────────────┘        └───────────────────────────┘
```

---

## 🛠 Tecnologías Usadas

### Backend
| Tecnología | Descripción |
|---|---|
| ![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white) | Lenguaje principal — lógica de negocio con patrón MVC |
| ![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?logo=postgresql&logoColor=white) | Sistema de gestión de base de datos relacional |
| ![PDO](https://img.shields.io/badge/PDO-PHP_Data_Objects-777BB4) | Capa de abstracción de base de datos con consultas preparadas |
| ![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=white) | Gestor de dependencias PHP |

### Frontend
| Tecnología | Descripción |
|---|---|
| ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black) | Interactividad del lado del cliente |
| ![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white) | Estilos y diseño visual del sistema |
| ![Font Awesome](https://img.shields.io/badge/Font_Awesome-528DD7?logo=fontawesome&logoColor=white) | Librería de íconos |

### Librerías Externas
| Librería | Uso |
|---|---|
| **PHPMailer** | Envío de correos electrónicos desde el sistema |
| **PhpOffice / PhpSpreadsheet** | Importación y exportación de archivos Excel |

### Infraestructura y Despliegue
| Tecnología | Descripción |
|---|---|
| ![Docker](https://img.shields.io/badge/Docker-2496ED?logo=docker&logoColor=white) | Contenedorización de la aplicación |
| ![Render](https://img.shields.io/badge/Render-46E3B7?logo=render&logoColor=black) | Plataforma de despliegue en la nube |
| ![Apache](https://img.shields.io/badge/Apache-D22128?logo=apache&logoColor=white) | Servidor web (entorno local con XAMPP) |

---

## 📁 Estructura del Proyecto

```
projectRetencion/
│
├── app/
│   ├── config/             # Configuración global del sistema
│   │   ├── global.php      # Conexión a base de datos PostgreSQL
│   │   ├── routes.php      # Definición de todas las rutas HTTP
│   │   └── email.php       # Configuración del servicio de correo
│   │
│   ├── controllers/        # Controladores MVC (lógica de flujo)
│   │   └── loginController.php
│   │   └── ...
│   │
│   ├── models/             # Modelos MVC (lógica de negocio y CRUD)
│   │   └── ...
│   │
│   ├── views/              # Vistas MVC (interfaz de usuario HTML)
│   │   └── admin_layout.php  # Layout base del panel administrativo
│   │   └── ...
│   │
│   └── libraries/          # Clases auxiliares reutilizables
│
├── bd/                     # Scripts SQL del modelo relacional
│   └── schema.sql
│
├── public/                 # Punto de entrada público de la aplicación
│   ├── css/                # Hojas de estilo
│   ├── img/                # Imágenes y recursos gráficos
│   ├── js/                 # Scripts JavaScript del cliente
│   ├── .htaccess           # Configuración de rutas y redirecciones
│   ├── index.php           # Front Controller — punto de entrada principal
│   └── test_drivers.php    # Script de prueba de conexión a BD
│
├── vendor/                 # Dependencias externas (Composer)
│   ├── phpmailer/          # Librería para envío de correos
│   └── phpoffice/          # Librería para manejo de Excel
│
├── Dockerfile              # Configuración Docker para despliegue
├── .env.example            # Plantilla de variables de entorno
└── README.md               # Este archivo
```

---

## ⚙️ Requisitos del Sistema

Antes de instalar el proyecto, asegúrate de tener instalado:

- **PHP** >= 8.0
- **PostgreSQL** >= 13
- **Composer** (gestor de dependencias PHP)
- **Apache** o servidor web compatible (XAMPP recomendado para desarrollo local)
- **Docker** (opcional, para despliegue con contenedores)
- **Git**

---

## 🚀 Instalación y Configuración

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/sena-contigo.git
cd sena-contigo
```

### 2. Instalar dependencias con Composer

```bash
composer install
```

### 3. Configurar las variables de entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` con tus credenciales (ver sección [Variables de Entorno](#️-variables-de-entorno)).

### 4. Configurar la base de datos

Crea la base de datos en PostgreSQL e importa el esquema:

```bash
psql -U tu_usuario -c "CREATE DATABASE sena_contigo;"
psql -U tu_usuario -d sena_contigo -f bd/schema.sql
```

### 5. Iniciar el servidor de desarrollo

```bash
php -S localhost:8080 -t public
```

O bien, párarte directamente en la carpeta `public`:

```bash
cd public
php -S localhost:8080
```

La aplicación estará disponible en: **http://localhost:8080**

---

## 🗝️ Variables de Entorno

Crea un archivo `.env` en la raíz del proyecto con las siguientes variables:

```env
# Base de Datos PostgreSQL
DB_HOST=localhost
DB_PORT=5432
DB_NAME=sena_contigo
DB_USER=tu_usuario
DB_PASSWORD=tu_contraseña
DATABASE_URL=postgresql://usuario:contraseña@host:5432/sena_contigo

# Configuración de Correo (PHPMailer)
MAIL_HOST=smtp.tuservidor.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@dominio.com
MAIL_PASSWORD=tu_contraseña_correo
MAIL_FROM=noreply@senacontigo.com
MAIL_FROM_NAME="SENA Contigo"

# Entorno de la aplicación
APP_ENV=development
APP_URL=http://localhost:8080
```

> ⚠️ **Nunca subas el archivo `.env` al repositorio.** Está incluido en el `.gitignore`.

---

## 🗄️ Base de Datos

El sistema utiliza **PostgreSQL** como motor de base de datos. El modelo relacional incluye las siguientes entidades principales:

| Tabla | Descripción |
|---|---|
| `usuarios` | Administradores, instructores, coordinadores, bienestar y aprendices voceros |
| `programas` | Programas de formación técnica y tecnológica |
| `grupos` | Fichas de aprendizaje asociadas a cada programa |
| `aprendices` | Información y estado de cada aprendiz |
| `categorias` | Categorías de riesgo de deserción |
| `causas` | Causas específicas de riesgo (académicas, personales, familiares) |
| `intervenciones` | Registro de intervenciones realizadas |
| `estrategias` | Estrategias de apoyo aplicadas por aprendiz |
| `reportes` | Reportes generados por instructores y coordinadores |

### Verificar conexión a la base de datos

Puedes verificar la conexión accediendo a:

```
http://localhost:8080/test_drivers.php
```

---

## 🔒 Seguridad

El sistema implementa las siguientes prácticas de seguridad:

- **Encriptación de contraseñas** con `password_hash()` y `PASSWORD_DEFAULT` (bcrypt)
- **Verificación segura** con `password_verify()` — nunca se almacenan contraseñas en texto plano
- **Consultas preparadas** con PDO para prevenir **SQL Injection**
- **Control de sesiones** con tiempo de inactividad y regeneración de ID: `session_regenerate_id()`
- **Autenticación por roles** — cada rol accede únicamente a sus módulos autorizados
- **Recuperación segura de contraseña** mediante token de un solo uso enviado al correo

---

## ☁️ Despliegue

El proyecto está configurado para desplegarse en **Render** usando **Docker**.

### Con Docker (local)

```bash
# Construir la imagen
docker build -t sena-contigo .

# Ejecutar el contenedor
docker run -p 8080:8080 --env-file .env sena-contigo
```

### En Render (producción)

1. Conecta tu repositorio de GitHub a [Render](https://render.com)
2. Render detectará automáticamente el `Dockerfile`
3. Configura las variables de entorno en el panel de Render (especialmente `DATABASE_URL`)
4. Render construirá y desplegará la imagen automáticamente

> 📄 Para instrucciones detalladas paso a paso del despliegue en Render, consulta el documento: **"Documentación de Despliegue del Sistema en Render con Docker"**

---

## 👥 Equipo

Proyecto desarrollado por aprendices del **SENA — Centro de Procesos Industriales y Construcción (CPIC)**:

| Nombre | Rol |
|---|---|
| **Jeferson Hernandez** | Fullstack Developer / Scrum Master |
| **Juan Manuel Zuluaga** | Frontend Developer |
| **Jose Miguel Sierra** | Frontend Developer |

> 📅 *Proyecto formativo — Octubre 2025*

---

## 📄 Licencia

Este proyecto fue desarrollado con fines educativos y formativos en el marco del SENA. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

<div align="center">

**⭐ Si este proyecto te fue útil, no olvides darle una estrella al repositorio ⭐**

Hecho con ❤️ por aprendices del **SENA CPIC**

</div>
