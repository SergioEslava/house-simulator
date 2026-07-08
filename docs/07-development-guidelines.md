# 07 - Development Guidelines

## Objetivo

Este documento define las convenciones y buenas prácticas que deberán seguirse durante el desarrollo de **House Simulator**.

Su propósito es mantener una base de código consistente, legible y fácil de mantener, independientemente del número de desarrolladores que participen en el proyecto.

---

# Principios generales

Todo el desarrollo deberá seguir los siguientes principios:

* Simplicidad.
* Legibilidad.
* Consistencia.
* Modularidad.
* Extensibilidad.
* Reutilización.
* Bajo acoplamiento.

Siempre deberá priorizarse un código fácil de entender frente a soluciones excesivamente complejas.

---

# Estándares

El proyecto seguirá los siguientes estándares.

## PSR

* PSR-1
* PSR-4
* PSR-12

---

## Tipado estricto

Todos los archivos PHP deberán declarar tipado estricto.

```php
declare(strict_types=1);
```

Se utilizarán tipos en:

* parámetros;
* valores de retorno;
* propiedades;
* constantes cuando sea posible.

---

# Estilo de código

El código deberá mantenerse uniforme en todo el proyecto.

Para ello se utilizará Laravel Pint como formateador oficial.

No deberán realizarse modificaciones manuales que contradigan las reglas del formateador.

---

# Análisis estático

El proyecto utilizará PHPStan para realizar análisis estático del código.

Objetivos:

* detectar errores antes de la ejecución;
* mejorar el tipado;
* reducir errores de mantenimiento.

Se recomienda utilizar el nivel de análisis más alto que resulte compatible con el proyecto.

---

# Organización del código

Cada clase deberá tener una única responsabilidad.

Se evitarán clases excesivamente grandes o con múltiples propósitos.

Cuando una clase comience a asumir responsabilidades adicionales deberá dividirse en componentes más pequeños.

---

# Controladores

Los controladores deberán permanecer extremadamente pequeños.

Su responsabilidad será únicamente:

* recibir la petición;
* delegar en un Service;
* devolver una respuesta.

No deberán contener:

* consultas complejas;
* lógica de negocio;
* cálculos;
* generación de datos.

---

# Services

Toda la lógica de negocio deberá implementarse mediante Services.

Los Services podrán colaborar entre sí siempre que mantengan responsabilidades claramente diferenciadas.

---

# Models

Los modelos Eloquent representan únicamente la persistencia.

Se limitarán a contener:

* relaciones;
* scopes;
* mutadores;
* accesores;
* pequeñas reglas relacionadas con la persistencia.

La lógica de negocio deberá permanecer fuera de ellos.

---

# API Resources

Todas las respuestas JSON deberán construirse mediante API Resources.

No deberán devolverse modelos Eloquent directamente desde los controladores.

---

# Validaciones

Las validaciones HTTP deberán implementarse mediante Form Requests.

No deberán escribirse reglas de validación directamente en los controladores.

---

# Inyección de dependencias

Las dependencias deberán resolverse mediante el contenedor de servicios de Laravel.

Se evitará la creación manual de dependencias utilizando `new`, salvo cuando resulte claramente apropiado.

---

# Facades

Los Facades podrán utilizarse cuando mejoren la legibilidad del código.

Sin embargo, para componentes propios del proyecto se preferirá siempre la inyección de dependencias.

---

# Enums

Siempre que un conjunto de valores sea conocido en tiempo de desarrollo y no dependa de la configuración almacenada en la base de datos, se recomienda utilizar Enums de PHP.

Ejemplos:

* tipos internos;
* modos de simulación;
* estados técnicos.

Cuando la información deba ser configurable por la aplicación, deberá almacenarse en la base de datos.

---

# Acceso a datos

Las consultas deberán realizarse utilizando Eloquent siempre que resulte razonable.

Cuando una consulta requiera optimizaciones específicas podrán utilizarse Query Builder o consultas SQL nativas, siempre debidamente justificadas.

---

# Comentarios

El código debe ser suficientemente expresivo como para minimizar la necesidad de comentarios.

Los comentarios deberán utilizarse únicamente para:

* explicar decisiones complejas;
* documentar limitaciones;
* justificar comportamientos no evidentes.

No deberán utilizarse comentarios para describir código que ya resulta evidente.

---

# Nomenclatura

Se seguirán las convenciones habituales de Laravel.

## Clases

PascalCase.

Ejemplo:

```text
TemperatureSimulationDriver
```

---

## Métodos

camelCase.

Ejemplo:

```text
generateReading()
```

---

## Variables

camelCase.

Ejemplo:

```text
$currentTemperature
```

---

## Constantes

UPPER_SNAKE_CASE.

---

# Estructura de métodos

Se recomienda mantener los métodos pequeños.

Como norma general:

* una única responsabilidad;
* pocas dependencias;
* pocas líneas de código.

Si un método requiere múltiples niveles de indentación probablemente deba dividirse.

---

# Manejo de errores

Los errores deberán representarse mediante excepciones.

No deberán utilizarse códigos de retorno especiales para indicar errores.

Las excepciones deberán ser específicas siempre que sea posible.

---

# Logging

Se utilizará el sistema de logging de Laravel para registrar:

* errores inesperados;
* excepciones;
* fallos de simulación;
* problemas de infraestructura.

No deberán registrarse mensajes de depuración permanentes en producción.

---

# Pruebas

Toda nueva funcionalidad deberá ir acompañada de sus correspondientes pruebas.

Siempre que resulte posible deberán escribirse primero las pruebas del comportamiento esperado.

La estrategia de testing se documenta en `08-testing.md`.

---

# Dependencias

Antes de incorporar una nueva dependencia externa deberá evaluarse:

* si Laravel ya proporciona esa funcionalidad;
* el mantenimiento del paquete;
* su popularidad;
* su compatibilidad con Laravel 12;
* su impacto sobre el proyecto.

Se evitará añadir dependencias innecesarias.

---

# Documentación

Toda decisión arquitectónica relevante deberá reflejarse en la documentación del proyecto.

Cuando una modificación afecte al diseño, la documentación deberá actualizarse junto con el código.

La documentación forma parte del proyecto y deberá mantenerse sincronizada con su implementación.

---

# Filosofía del proyecto

House Simulator pretende ser un proyecto sencillo, bien estructurado y fácil de entender.

Todas las decisiones de desarrollo deberán orientarse a:

* escribir menos código, pero mejor organizado;
* facilitar la incorporación de nuevos dispositivos;
* mantener una API consistente;
* desacoplar la simulación del resto de la aplicación;
* favorecer la mantenibilidad a largo plazo.

La prioridad nunca será construir la solución más compleja, sino la más clara y fácil de evolucionar.
