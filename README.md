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
  - Node.js (opcional, para compilar activos de frontend).
  - Servidor MySQL.

### Instrucciones
1. **Clonar el repositorio:**
   ```bash
   git clone <url-del-repositorio>
   cd <nombre-del-directorio>
