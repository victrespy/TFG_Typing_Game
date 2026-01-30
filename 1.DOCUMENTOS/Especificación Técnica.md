# Especificación Técnica: Roguelike de Mecanografía (Web)

## 1. Introducción y Visión General

El proyecto consiste en el desarrollo de una aplicación web que integra mecánicas de videojuego "Roguelike" basadas en la mecanografía (typing game). El sistema permitirá a los usuarios mejorar su velocidad y precisión de escritura mediante un sistema de combate, selección de héroes, progresión persistente y desbloqueo de historia.

La plataforma contará con gestión de usuarios, modos de juego "Solo" (Historia) y "Multijugador" (1 vs 1), y un panel de administración para la gestión de contenidos y eventos.

## 2. Stack Tecnológico y Arquitectura

Para garantizar la escalabilidad, seguridad y rendimiento del proyecto, se ha seleccionado la siguiente arquitectura:

### 2.1. Backend (Lógica del Servidor)

- **Framework:** **Symfony 6/7** (PHP 8.2+).
- **Arquitectura:** MVC (Modelo-Vista-Controlador).
- **API:** API Platform (opcional) o controladores nativos para la comunicación asíncrona con el frontend del juego.
- **Tiempo Real (Multijugador):** **Symfony Mercure Hub** o **WebSockets** (vía Ratchet) para la sincronización de partidas 1 vs 1.

### 2.2. Base de Datos (Persistencia)

- **Motor:** **PostgreSQL**.
- **ORM:** Doctrine.
- **Justificación:** PostgreSQL ofrece un excelente manejo de integridad relacional y soporte robusto para tipos de datos JSON, útil para guardar configuraciones de "runs" o estadísticas complejas.

### 2.3. Frontend (Interfaz de Usuario)

- **Motor de Plantillas:** Twig (para vistas estáticas, login, dashboard).
- **Lógica del Juego:** JavaScript Moderno (ES6+) manipulando el DOM o Canvas API.
- **Audio:** **Howler.js** o Web Audio API nativa para gestión de SFX y música.
- **Estilos:** CSS3 / Framework (Tailwind) para la UI.

## 3. Arquitectura de Datos (Modelo Entidad-Relación)



## 4. Módulos Funcionales

### 4.1. Módulo de Autenticación y Roles

- **Login/Registro:** Formulario estándar de Symfony.
- **Jugador (ROLE_USER):** Acceso a jugar, ver estadísticas y perfil.
- **Administrador (ROLE_ADMIN):**
    - CRUD de Usuarios (Ver lista, eliminar usuarios).
    - Gestión de Eventos (Crear eventos especiales del juego).

### 4.2. Módulo de Juego (Core Loop)

La lógica del juego residirá principalmente en el cliente (JS), comunicándose con Symfony para validar resultados y guardar progreso.

#### 4.2.1. Selección de Personaje (Inicio de Run)

- Antes de iniciar la partida, el jugador selecciona uno de los personajes disponibles.
- Cada personaje aplica modificadores iniciales a la partida (Ej: Uno tiene menos vida pero las vocales hacen +1 de daño extra).

#### 4.2.2. Combate y Daño

- **Enemigos:** Entidades con `HP` y `AttackTimer`.
- **Cálculo de Daño:**
    - Cada letra tiene un `base_damage` (inicial 1) + `run_upgrade` + `mastery_bonus`.
    - Al completar una palabra: `Daño Total = Σ (Daño de cada letra)`.
    - El daño se resta a la HP del enemigo.

#### 4.2.3. Sistema de Run (Partida)

- **Niveles:** Secuenciales.
- **Recompensas:**
    - _Fin de nivel:_ Selección de 3 letras aleatorias -> +1 daño (temporal para la run).
    - _Cada 5 niveles:_ "Mejora Mayor" (Ej: Curas) + Recuperación de 5 PV.
- **Game Over:** Si PV Jugador llega a 0 -> Fin de la run -> Guardado de estadísticas.

#### 4.2.4. Progresión Meta-Juego (Persistencia)

- **Maestrías de Letras:**
    - Se chequea al final de la run.
    - Niveles: Daño 3 (Nvl 2), Daño 5 (Nvl 3), Daño 10 (Nvl 4).
    - _Efecto:_ Si una letra tiene Maestría N, sus mejoras in-game otorgan +N daño en lugar de +1.

- **Suerte:**
    - Contador global: Cada 10 subidas de nivel de maestría (cualquier letra) = +% Suerte.
    - _Efecto:_ Probabilidad de que aparezcan 4 opciones de mejora en lugar de 3.

- **Misiones de Desbloqueo:**
    - Ej: "Alcanzar nivel 7" -> Desbloquea aparición de mejoras de cura en futuras runs.

### 4.3. Módulo Historia (Lore)

- **Inicio de Run:** El sistema calcula el porcentaje de conseguir una pieza de Lore en base a la suerte de la parida
- **Condición de Victoria:** Llegar al nivel final Y haber completado el Lore requerido.
- **Mecánica de Lore:** Si el porcentaje calculado es menor a la suerte, el jugador debe **mecanografiar el fragmento de historia** para desbloquearlo permanentemente.

### 4.4. Módulo Multijugador (1 vs 1) (*No se implementará de momento*)

- **Tecnología:** WebSockets / Mercure.
- **Modos:**
    - _Matchmaking Aleatorio:_ Cola de espera en servidor.
    - _Sala Privada:_ Generación de código único para invitar a un amigo.
- **Interacción:**
    - Pantalla dividida o indicador de progreso del rival.
    - "Ataque": Completar palabras rápido puede enviar "basura" o acelerar el ataque del enemigo del rival (opcional, definir reglas de interacción).
    - Sincronización de estado: `HP`, `Nivel Actual`, `Vivo/Muerto`.

### 4.5. Módulo de Audio

- **Banda Sonora (BGM):** Música ambiental que varía según la fase o la intensidad del combate (menú, combate normal, combate boss).
- **Efectos de Sonido (SFX):**
    - _Feedback positivo:_ Sonido satisfactorio al completar palabra o letra crítica.
    - _Feedback negativo:_ Sonido de error al fallar una tecla.
    - _UI:_ Clics en menús y mejoras.
- **Control:** El usuario podrá ajustar volúmenes de BGM y SFX independientemente desde la configuración.

## 5. Requisitos No Funcionales

- **Rendimiento:** La latencia de escritura (input lag) debe ser mínima en el frontend. La carga de audio debe ser asíncrona para no bloquear el inicio del juego.
- **Seguridad:** Validación en servidor (Symfony) de los resultados de la partida para evitar trampas.
- **Usabilidad:** Diseño responsive, optimizado para teclado físico. Feedback auditivo y visual claro.

## 6. Plan de Desarrollo (Hitos Sugeridos)

1. **Fase 1:** Setup de Symfony, Docker, PostgreSQL y Entidades Base (incluyendo Personajes).
2. **Fase 2:** Motor de juego base (JS) + Audio Básico + Diccionario Fase 1.
3. **Fase 3:** Sistema de mejoras (Roguelike), Selección de Personaje y persistencia.
4. **Fase 4:** Implementación de Maestrías y Lore.
5. **Fase 5:** Multijugador en tiempo real.