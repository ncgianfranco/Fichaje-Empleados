# Employee Attendance and Leave Management System

Este proyecto es una aplicación web diseñada para gestionar de manera eficiente los registros de asistencia y solicitudes de permisos de los empleados. Incluye funcionalidades tanto para empleados como para administradores, brindando un flujo de trabajo estructurado para registrar horarios, generar reportes y administrar permisos.

## Autores

- **Gianfranco Nolasco Camacho**
- **David Ramos de Haro**

---

## Funcionalidades principales

### Para empleados:
- **Registro de asistencia:** Los empleados pueden fichar su hora de entrada y salida.
- **Solicitudes de permisos:** Enviar solicitudes de permisos por vacaciones, enfermedad, u otros motivos.
- **Recuperación de contraseña:** Restablecer la contraseña mediante correo electrónico.

### Para administradores:
- **Gestión de asistencias:** Visualizar y filtrar registros de asistencia por empleado y rango de fechas.
- **Generación de reportes:** Exportar registros en formato PDF y CSV.
- **Gestión de permisos:** Aprobar o rechazar solicitudes de permisos enviadas por los empleados.

### Tecnologías utilizadas:
- **Backend:** Laravel (PHP Framework).
- **Frontend:** Blade (Sistema de plantillas de Laravel) con HTML y CSS.
- **Base de datos:** MySQL.
- **Servidor de correo:** Configuración SMTP con Gmail para enviar correos.

---

## Instalación

Sigue estos pasos para instalar y ejecutar el proyecto localmente:

### Requisitos previos
- Tener instalado:
  - PHP (v8.1 o superior).
  - Composer.
  - Servidor MySQL.

### Instrucciones
1. **Clonar el repositorio:**
   ```bash
   git clone <url-del-repositorio>
   cd <nombre-del-directorio>
   ```
2. **Instalar Dependencias:
    ````bash
    composer install
    ````
3. **Configurar el entorno:**
    Renombra el archivo .env.example a .env:
   ```bash
    cp .env.example .env
   ````
   Configura la base de datos en el archivo .env:
   ```bash
       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=<nombre_de_tu_bd>
       DB_USERNAME=<tu_usuario>
       DB_PASSWORD=<tu_contraseña>
    ```
   Configura el servidor SMTP en el archivo .env:
   ```bash
       MAIL_MAILER=smtp
       MAIL_HOST=smtp.gmail.com
       MAIL_PORT=587
       MAIL_USERNAME=<tu_correo@gmail.com>
       MAIL_PASSWORD=<contraseña_de_aplicación>
       MAIL_ENCRYPTION=tls
       MAIL_FROM_ADDRESS=<tu_correo@gmail.com>
       MAIL_FROM_NAME="Gestión Asistencias"
   ```
4. **Migrar y sembrar la base de datos:**
    ```bash
   php artisan migrate --seed
    ```

5. **Levantar el servidor:**
    ```bash
    php artisan serve
    ```
6. **Acceder a la aplicación: Abre tu navegador y visita http://127.0.0.1:8000.:**

## Notas adicionales

### Configuración SMTP:
Asegúrate de habilitar el acceso a aplicaciones menos seguras en tu cuenta de Gmail o utiliza una contraseña específica para aplicaciones.
Revisa la configuración de tu servidor si experimentas problemas de envío de correos.
### Para empleados:
Usuario administrador: Correo: admin@example.com Contraseña: password
Usuario empleado: Correo: employee@example.com Contraseña: password
### Depuración:
En caso de errores, habilita APP_DEBUG=true en el archivo .env para obtener más información.

---

## Referencias bibliográficas
[Laravel Framework Documentation](https://laravel.com/docs)
[MySQL Documentation](https://dev.mysql.com/doc/)
[Configuración de SMTP en Gmail: ](https://support.google.com/mail/)

## Licencia 
Este proyecto está licenciado bajo la Licencia MIT.
