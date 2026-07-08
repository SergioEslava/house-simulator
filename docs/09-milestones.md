# 09 - Development Milestones

## Objetivo

Este documento define la planificación del desarrollo de **House Simulator**.

El proyecto se desarrollará de forma incremental mediante una serie de hitos funcionales (*milestones*).

Cada milestone deberá finalizar con una aplicación completamente funcional respecto al alcance definido para esa fase.

---

# Filosofía

Cada milestone debe cumplir los siguientes objetivos:

* producir una aplicación ejecutable;
* evitar grandes refactorizaciones posteriores;
* servir de base para el siguiente hito.

---

# Milestone 1 - Proyecto base

## Objetivos

Crear la estructura inicial del proyecto.

## Funcionalidades

* Proyecto Laravel operativo.
* Configuración de MySQL.
* Migraciones iniciales.
* Modelos Eloquent.
* Relaciones entre modelos.
* Seeders iniciales.
* Factories básicas.

## Conceptos de Laravel

* Artisan.
* Migrations.
* Models.
* Seeders.
* Factories.
* Eloquent ORM.

## Resultado esperado

Una base de datos completamente funcional con la vivienda y todos los dispositivos registrados.

---

# Milestone 2 - API de consulta

## Objetivos

Exponer toda la información mediante una API REST.

## Funcionalidades

* Endpoints de consulta.
* API Resources.
* Form Requests.
* Filtros básicos.
* Respuestas JSON homogéneas.

## Conceptos de Laravel

* Routing.
* Controllers.
* API Resources.
* Form Requests.
* Route Model Binding.

## Resultado esperado

Toda la estructura de la vivienda puede consultarse mediante la API.

Todavía no existen datos simulados.

---

# Milestone 3 - Actuadores

## Objetivos

Permitir la interacción con los actuadores.

## Funcionalidades

* Cambio de estado.
* Validaciones.
* Persistencia.
* Actualización mediante PATCH.

## Conceptos de Laravel

* Services.
* Validaciones avanzadas.
* Transacciones.
* Excepciones.

## Resultado esperado

Las luces y persianas pueden consultarse y modificarse desde la API.

---

# Milestone 4 - Motor de simulación

## Objetivos

Implementar la primera versión del Simulation Engine.

## Funcionalidades

* Simulation Manager.
* Simulation Driver.
* Temperature Simulation Driver.
* Humidity Simulation Driver.
* Primera estrategia de simulación.

## Conceptos de Laravel

* Service Container.
* Dependency Injection.
* Arquitectura por capas.

## Resultado esperado

La aplicación es capaz de generar lecturas de sensores manualmente.

Todavía no existe automatización.

---

# Milestone 5 - Automatización

## Objetivos

Automatizar completamente la simulación.

## Funcionalidades

* Jobs.
* Scheduler.
* Generación automática de temperaturas.
* Generación automática de humedades.

## Conceptos de Laravel

* Jobs.
* Scheduler.
* Console Commands.

## Resultado esperado

La vivienda genera datos automáticamente sin intervención del usuario.

---

# Milestone 6 - Snapshot

## Objetivos

Implementar el principal endpoint del sistema.

## Funcionalidades

* Snapshot completo.
* Optimización de consultas.
* API Resources compuestos.

## Conceptos de Laravel

* Eager Loading.
* Relaciones complejas.
* Transformación de recursos.

## Resultado esperado

Una única petición devuelve el estado completo de la vivienda.

Este constituye el principal objetivo funcional del proyecto.

---

# Milestone 7 - Testing

## Objetivos

Incorporar una batería completa de pruebas automatizadas.

## Funcionalidades

* Unit Tests.
* Feature Tests.
* Factories para testing.
* Cobertura de la API.
* Cobertura del Simulation Engine.

## Conceptos de Laravel

* PHPUnit.
* Laravel Testing.
* Database Testing.
* HTTP Testing.

## Resultado esperado

El proyecto dispone de pruebas automatizadas para todos los componentes principales.

---

# Milestone 8 - Optimización

## Objetivos

Mejorar la calidad general del proyecto.

## Funcionalidades

* Optimización de consultas.
* Refactorización.
* Eliminación de código duplicado.
* Mejora de documentación.
* Revisión arquitectónica.

## Conceptos de Laravel

* Lazy Collections.
* Optimización de Eloquent.
* Herramientas de depuración.

## Resultado esperado

Proyecto preparado para una primera versión estable.

---

# Milestone 9 - Evolución

Este milestone no tiene un alcance cerrado.

Su objetivo es incorporar nuevas funcionalidades sin modificar la arquitectura existente.

Posibles ampliaciones:

* nuevos sensores;
* nuevos actuadores;
* múltiples viviendas;
* autenticación;
* WebSockets;
* Server-Sent Events;
* reglas domóticas;
* sistemas de riego;
* integración con dispositivos físicos;
* nuevas estrategias de simulación.

---

# Criterios de finalización

Un milestone se considerará finalizado cuando:

* todas sus funcionalidades estén implementadas;
* las pruebas correspondientes sean satisfactorias;
* la documentación esté actualizada;
* el código cumpla las guías de desarrollo definidas en este proyecto.

Ningún milestone deberá dejar el proyecto en un estado inestable.


