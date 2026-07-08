# 08 - Testing Strategy

## Objetivo

Este documento define la estrategia de pruebas de **House Simulator**.

El objetivo es garantizar la calidad del software mediante una batería de pruebas automatizadas que verifiquen el comportamiento del sistema y faciliten su evolución.

Las pruebas deberán centrarse en validar el comportamiento del dominio y no la implementación interna del framework.

---

# Principios

La estrategia de testing se basa en los siguientes principios:

* Automatización.
* Reproducibilidad.
* Independencia.
* Simplicidad.
* Rapidez de ejecución.
* Facilidad de mantenimiento.

Las pruebas deberán verificar el comportamiento esperado del sistema, evitando depender de detalles de implementación.

---

# Tipos de pruebas

El proyecto utilizará distintos niveles de pruebas.

## Unit Tests

Las pruebas unitarias verifican el comportamiento de una única clase o componente de forma aislada.

Deberán utilizarse principalmente para:

* Simulation Drivers.
* Simulation Strategies.
* Services.
* Componentes auxiliares.

Las pruebas unitarias no deberán depender de la base de datos siempre que sea posible.

---

## Feature Tests

Las pruebas funcionales validan la integración entre varios componentes.

Se utilizarán para comprobar:

* endpoints de la API;
* validaciones;
* respuestas JSON;
* interacción con la base de datos.

Estas pruebas verificarán el comportamiento observable por un cliente.

---

## Integration Tests

Cuando resulte necesario podrán escribirse pruebas de integración para validar la colaboración entre distintos componentes.

Ejemplos:

* Simulation Manager + Drivers.
* Services + Models.
* Scheduler + Jobs.

---

# Cobertura funcional

Las siguientes funcionalidades deberán estar cubiertas por pruebas.

## API

* Consulta de recursos.
* Filtros.
* Snapshot de la vivienda.
* Modificación de actuadores.
* Validación de estados.
* Códigos de respuesta.

---

## Motor de simulación

* Generación de temperaturas.
* Generación de humedades.
* Selección del driver adecuado.
* Persistencia de nuevas lecturas.

---

## Servicios

* Construcción del snapshot.
* Cambio de estado de actuadores.
* Consultas complejas.
* Reglas de negocio.

---

# Simulación determinista

Siempre que sea posible, las pruebas del motor de simulación deberán ser deterministas.

Esto significa que una misma entrada deberá producir siempre el mismo resultado esperado.

Las estrategias de simulación deberán diseñarse para facilitar este tipo de pruebas.

En el futuro, la incorporación de un `SimulationClock` permitirá controlar completamente el tiempo simulado durante la ejecución de las pruebas.

---

# Base de datos

Las pruebas que utilicen la base de datos deberán ejecutarse sobre una base de datos específica para testing.

Cada prueba deberá comenzar desde un estado conocido.

Se utilizarán las herramientas proporcionadas por Laravel para restaurar el estado de la base de datos entre pruebas.

---

# Datos de prueba

Los datos de prueba deberán generarse utilizando:

* Factories.
* Seeders específicos para testing cuando resulte necesario.

No deberán reutilizarse datos de producción.

---

# Mocking

Los mocks deberán utilizarse únicamente cuando resulten necesarios para aislar dependencias externas.

No deberán emplearse para ocultar una arquitectura difícil de probar.

Siempre que sea posible se preferirán implementaciones reales de los componentes del dominio.

---

# API Testing

Todas las rutas públicas deberán disponer de pruebas funcionales.

Como mínimo deberán verificarse:

* respuestas correctas;
* errores de validación;
* recursos inexistentes;
* modificación de actuadores;
* formato JSON.

---

# Simulation Engine Testing

Cada nuevo Simulation Driver deberá incorporar su propia batería de pruebas.

Como mínimo deberán verificarse:

* generación de valores válidos;
* respeto de los rangos definidos;
* continuidad respecto a la lectura anterior;
* comportamiento ante valores extremos.

---

# Performance

Las pruebas automatizadas deberán ejecutarse en un tiempo razonable.

Se recomienda:

* mantener las pruebas unitarias rápidas;
* limitar el uso de recursos externos;
* evitar operaciones innecesarias sobre la base de datos.

---

# Automatización

Toda la batería de pruebas deberá poder ejecutarse mediante un único comando.

Ejemplo:

```bash
php artisan test
```

En el futuro, las pruebas podrán integrarse en un proceso de Integración Continua (CI) para ejecutarse automáticamente en cada cambio del proyecto.

---

# Calidad del código

Antes de aceptar una nueva funcionalidad deberán ejecutarse, como mínimo:

* pruebas automatizadas;
* análisis estático con PHPStan;
* formateo mediante Laravel Pint.

Una modificación no deberá considerarse finalizada hasta superar todas estas comprobaciones.

---

# Cobertura

No se establece un porcentaje mínimo de cobertura como objetivo.

Se prioriza que las pruebas sean útiles y representativas del comportamiento del sistema frente a alcanzar un determinado porcentaje.

La calidad de las pruebas tendrá mayor importancia que la cantidad.

---

# Filosofía

House Simulator pretende mantener una base de código fiable y fácil de evolucionar.

Las pruebas constituyen una herramienta para facilitar esa evolución y ofrecer confianza ante futuras modificaciones.

Cada nueva funcionalidad debería incorporar las pruebas necesarias para demostrar su correcto funcionamiento y evitar regresiones en el comportamiento existente.
