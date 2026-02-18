# 🚀 DevWebCamp - Plataforma para Conferencias de Diseño


DevWebCamp es una aplicación web completa y dinámica (Full-Stack) diseñada para la gestión integral de conferencias y eventos. Permite a los usuarios registrarse, comprar boletos, armar su itinerario de conferencias y administrar su perfil, mientras que los administradores cuentan con un panel seguro para gestionar ponentes, eventos, regalos y usuarios registrados.

Este proyecto fue desarrollado construyendo un **Framework MVC propio en PHP desde cero**, aplicando las mejores prácticas de programación orientada a objetos (POO), seguridad y optimización de bases de datos.

## 🛠️ Stack Tecnológico

**Front-end:**
* HTML5 & CSS3 (Metodologías BEM y Arquitectura de Módulos)
* SASS para preprocesamiento de estilos
* JavaScript Moderno (ES6+)
* Fetch API (Consumo asíncrono de datos)
* Gulp / Webpack y NPM (Workflows de desarrollo)

**Back-end & Base de Datos:**
* PHP 8+ (POO)
* Arquitectura MVC (Modelo-Vista-Controlador)
* Gestión de dependencias con Composer
* MySQL (Modelado relacional, consultas preparadas)
* Integración de APIs de terceros (Envío de emails y pasarelas de pago modernas, superando las limitaciones de APIs tradicionales)

## 🏗️ Arquitectura y Base de Datos

El sistema está construido sobre el patrón de diseño **MVC**, separando la lógica de negocio, la interfaz de usuario y el manejo de peticiones para garantizar un código escalable y mantenible.

* **Modelos (Models):** Clases Active Record en PHP que interactúan directamente con las tablas de MySQL. Se implementó un modelado relacional robusto, incluyendo la gestión de Foreign Keys entre entidades críticas (por ejemplo, relacionando la tabla de `registros` con la de `regalos` y `usuarios`).
* **Vistas (Views):** Interfaces dinámicas renderizadas desde el servidor, combinadas con interactividad asíncrona vía JavaScript.
* **Controladores (Controllers):** Encargados de procesar las rutas, validar datos y coordinar la respuesta entre la base de datos y la vista.

## ✨ Funcionalidades Principales

### Para Usuarios 👥
* **Autenticación Segura:** Sistema de login y registro con contraseñas hasheadas.
* **Recuperación de Acceso:** Flujo seguro para restablecer contraseñas mediante tokens enviados por email.
* **Selección de Paquetes y Pagos:** Compra de boletos (presenciales o virtuales) integrando una API de pasarela de pago eficiente y escalable.
* **Itinerario Personalizado:** Una vez procesado el pago, los usuarios pueden reservar su lugar en workshops y conferencias específicas (validación de cupos en tiempo real).
* **Boleto Virtual:** Generación dinámica de un boleto único y compartible.

### Para Administradores 🔐
* **Panel de Administración (Dashboard):** Área protegida mediante manejo de sesiones en PHP para gestionar la plataforma de forma segura.
* **Operaciones CRUD:** Creación, lectura, actualización y eliminación de Ponentes, Eventos (Conferencias/Workshops) y Categorías.
* **Gestión de Registros:** Visualización en tiempo real de los ingresos y boletos vendidos.
* **Paginación:** Sistema de paginación implementado desde el backend para optimizar la carga de grandes volúmenes de datos en el panel.

## 🚀 Instalación y Despliegue Local (Virtual Host con XAMPP)

Para evitar problemas con rutas relativas y simular un entorno de producción, este proyecto requiere la configuración de un **Virtual Host** en XAMPP.

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/FacuLedesmaBertalot/DevWebCamp.git](https://github.com/FacuLedesmaBertalot/DevWebCamp.git)
