# House Simulator

## Objetivo

**House Simulator** es una API REST desarrollada con **Laravel 12** cuyo objetivo es simular el comportamiento de una vivienda domotizada.

La aplicación genera y mantiene el estado de una serie de **sensores virtuales** y **actuadores**, permitiendo que otros sistemas consulten e interactúen con ellos mediante una API REST.

El proyecto no incluye ninguna interfaz de usuario. Su única responsabilidad es ofrecer un entorno de simulación que actúe como proveedor de datos para aplicaciones cliente externas.

## Alcance

La simulación contempla diferentes elementos de una vivienda:

### Sensores

* Sensores de temperatura.
* Sensores de humedad para plantas del patio.

### Actuadores

* Ventanas de la vivienda.
* Puerta principal.
* Puerta del patio.
* Luces de las habitaciones.
* Luces del patio.

La simulación deberá mantener el estado de todos estos elementos y permitir su consulta y modificación a través de la API cuando corresponda.

## Objetivos del proyecto

* Proporcionar una API REST limpia y consistente.
* Simular el comportamiento de una vivienda domotizada.
* Mantener un estado persistente de sensores y actuadores.
* Facilitar el desarrollo de aplicaciones cliente que consuman estos datos.
* Mantener una arquitectura sencilla, modular y fácilmente ampliable con nuevos dispositivos en el futuro.

## Fuera del alcance

Este proyecto **no** incluye:

* Interfaces web o móviles.
* Dashboards de visualización.
* Automatizaciones domóticas complejas.
* Integración con dispositivos físicos reales.
* Sistemas de autenticación de usuarios finales (salvo que sean necesarios para proteger la API).

## Tecnologías

* Laravel 12
* PHP 8.3
* MySQL

## Documentación

Toda la documentación del proyecto se encuentra en la carpeta `docs/`.

| Documento                                                         | Descripción                                            |
| ----------------------------------------------------------------- | ------------------------------------------------------ |
| [01-project-overview.md](docs/01-project-overview.md)             | Visión general del proyecto y objetivos funcionales.   |
| [02-domain-model.md](docs/02-domain-model.md)                     | Modelo de dominio: sensores, actuadores y zonas.       |
| [03-database.md](docs/03-database.md)                             | Diseño de la base de datos.                            |
| [04-api.md](docs/04-api.md)                                       | Especificación de la API REST.                         |
| [05-architecture.md](docs/05-architecture.md)                     | Arquitectura general de la aplicación.                 |
| [06-simulation-engine.md](docs/06-simulation-engine.md)           | Funcionamiento de la simulación y generación de datos. |
| [07-development-guidelines.md](docs/07-development-guidelines.md) | Convenciones y normas de desarrollo.                   |
| [08-testing.md](docs/08-testing.md)                               | Estrategia de pruebas.                                 |
| [09-milestones.md](docs/09-milestones.md)                         | Planificación del proyecto por hitos (milestones).     |

