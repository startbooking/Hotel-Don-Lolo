Eres un desarrollador full-stack experto responsable de construir una aplicación web de **Contabilidad Hotelera para Colombia** usando **PHP (Laravel)** para el backend, **MySQL** para la base de datos, **TailwindCSS** para estilos y **JavaScript** para interactividad (puedes usar Alpine.js para reactividad ligera). Tu objetivo es entregar el proyecto **fase por fase**, cada fase en una respuesta separada. Respeta las siguientes reglas generales y los detalles por fase.

### Reglas generales
1. **Stack recomendado:** PHP 8.1+, Laravel 10 (o la versión LTS más estable disponible), MySQL 8, TailwindCSS, Blade + Alpine.js (vanilla JS si lo prefieres).
2. **Entrega por fase:** Entrega sólo la fase solicitada en cada mensaje. Cada entrega debe incluir:
   - Código listo para `git` (carpeta con archivos o diffs).
   - Migrations y seeders.
   - Tests (PHPUnit) básicos que cubran la funcionalidad core de la fase.
   - Archivo `README.md` con instrucciones para ejecutar esa fase (docker-compose recomendado), y `env.example`.
   - Ejemplos de datos (seeders) con datos realistas para Colombia (COP, formatos de fecha dd/mm/yyyy).
   - Postman collection o especificación OpenAPI mínima para las rutas públicas.
   - Capturas (si es UI) o comandos para probar (curl/php artisan).
3. **Seguridad:** hashing de contraseñas, validación de inputs, protección contra CSRF y SQL injection, roles y permisos (recomienda `spatie/laravel-permission`).
4. **Calidad:** seguir PSR-12, buenas prácticas Laravel, código bien documentado y modular.
5. **Internacionalización:** idioma por defecto `es-CO`, moneda `COP`, formatos de fecha y número configurables.
6. **Integración DIAN (facturación electrónica):** crea un módulo con **adapter pattern** que soporte *mock connector* + *conector real configurable por env vars*. NO incluyas credenciales; documenta pasos para obtener credenciales DIAN y cómo activar el conector real (debe incluir pruebas contra entorno sandbox). Si la normativa exige formatos o certificados, documenta los pasos para integrarlos y cómo probar en sandbox.
7. **No hardcodear secretos.** Todo debe venir por `env`.
8. **Automatización:** incluye `docker-compose` para dev (app, mysql, phpmyadmin) y comandos para migrar/seed/test.

---

## Fases (detalle con entregables y criterios)

### Fase 0 — Preparación del proyecto (entregable inicial)
**Tareas**
- Crear repo skeleton (composer.json, package.json, tailwind, vite/laravel-mix si procede).
- `docker-compose.yml` para desarrollo (php-fpm, nginx, mysql, phpmyadmin).
- `env.example`, `README.md` con comandos para arrancar.
- Configurar control de versiones (estructura de ramas sugerida: `main`, `develop`, `feature/*`).

**Entregables**
- Proyecto inicial con Laravel instalado y Tailwind configurado.
- `docker-compose up` que deje la app accesible.
- Migrations vacíos listos.
- Seeder que cree usuario admin (admin@hotel.local / password seguro).

**Criterios de aceptación**
- Puedo levantar la app con Docker y entrar al `/` (landing) con layout básico.
- `php artisan migrate --seed` corre sin errores.

---

### Fase 1 — Autenticación y roles
**Tareas**
- Implementar auth (Laravel Breeze o Fortify) con login/registro (registro solo admin/recepcionista/contador por seed).
- Roles: `admin`, `contador`, `recepcionista`. Uso de `spatie/laravel-permission`.
- Middleware por rol para rutas.
- UI login/logout/reseteo de contraseña (form modal o página).

**Entregables**
- Migrations roles/permissions.
- Seed con 3 usuarios y sus roles.
- Tests: login exitoso, acceso denegado a ruta protegida.
- Documentación de endpoints y roles.

**Criterios**
- Usuarios sólo acceden a rutas según su rol.
- Password reset via email (puede usar log driver en dev).

---

### Fase 2 — Gestión hotelera básica (habitaciones y reservas)
**Tareas**
- Tablas y UI: `room_types`, `rooms`, `reservations`, `guests`.
- CRUD habitaciones y tipos, calendario simple de reservas.
- Cuando se crea una reserva, generar folio/pre-factura con items (noche, extras).
- Estado de habitación: disponible/ocupada/mantenimiento.
- Endpoints API para crear/listar reservas.

**Entregables**
- Migrations + seeders (ejemplo hotel con 10 habitaciones).
- UI pages: Lista de habitaciones, formulario reserva, vista de reserva.
- Tests: crear reserva, evitar doble-booking de misma habitación.

**Criterios**
- No se puede reservar una habitación ya ocupada en el rango de fechas.
- Reserva genera un folio con totales y impuestos configurables.

---

### Fase 3 — Módulo de facturación (facturas y pagos)
**Tareas**
- Modelos: `invoices`, `invoice_items`, `payments`.
- Generación de factura desde reserva o venta directa (restaurante).
- Registro de pagos (múltiples pagos, métodos: efectivo, tarjeta, transferencia).
- Número de factura secuencial (configurable por serie).
- Exportar factura en PDF (Dompdf/laravel-snappy) y generar XML/JSON compatible para DIAN adapter.

**Entregables**
- CRUD facturas, PDF descargable (plantilla profesional).
- Tests: creación de factura, pago parcial, cierre factura.
- Endpoint para descargar PDF y para obtener JSON para firma/DIAN.

**Criterios**
- Suma de items = total de la factura; los pagos aplican correctamente.
- PDF correcto con datos fiscales del hotel (NIT, dirección).

---

### Fase 4 — Núcleo contable (plan de cuentas y asiento automático)
**Tareas**
- Tablas: `chart_of_accounts`, `journal_entries`, `journal_lines`, `fiscal_periods`.
- Implementar reglas de contabilización automática:
  - Al facturar -> generar asiento de ventas (clientes / cuentas de ingresos / impuestos a pagar).
  - Al registrar pago -> asiento (caja/banco / cuentas por cobrar).
- UI para ver libro mayor y crear asientos manuales (con flujo de aprobación para `contador`).

**Entregables**
- Migrations plan de cuentas.
- Automatización de asientos al crear factura/pago.
- Reports: libro mayor, mayor por cuenta, balance de comprobación.
- Tests unitarios de generación de asientos.

**Criterios**
- Las transacciones deben balancear (debe existir la misma suma en debe/haber).
- Periodos fiscales bloqueables.

---

### Fase 5 — Reportes y exportaciones
**Tareas**
- Estados financieros: Balance general, Pérdidas y Ganancias, Flujo de caja (periodo escogido).
- Reportes hoteleros: ocupación, ADR, RevPAR, ingresos por habitación, ingresos por departamento (restaurante, eventos).
- Export a Excel (PhpSpreadsheet) y PDF para todos los reportes.

**Entregables**
- UI con filtros por fecha, contrato, cuarto, departamento.
- Export buttons (Excel, PDF).
- Tests de integridad de datos en reportes.

**Criterios**
- Los reportes deben ser congruentes con los asientos contables.
- Exports descargables sin errores.

---

### Fase 6 — Integración DIAN y facturación electrónica (módulo)
**Tareas**
- Diseñar un **adapter** que permita:
  - `MockConnector` para
