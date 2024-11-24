### ac1Dmarv3L/docker-php-nginx

---

This repository provides a lightweight and flexible Docker template for PHP web development with Nginx as the web server. It's tailored for developers who value simplicity and performance while adhering to modern containerization best practices.

Features:

- Optimized Docker Setup: Separate containers for PHP-FPM and Nginx for better modularity.
- Easy to Use: Ready-to-go configuration with minimal setup for new projects.
- Log Management: Centralized logging directories for Nginx and PHP, with support for persistent mapping.
- Environment Isolation: Fully isolated environment using Docker Compose.
- Support for Development and Production: Configurable for both development and production environments.

What's Included?

- Dockerfiles: Custom configurations for PHP-FPM and Nginx (both are Alpine-based).
- nginx.conf: Pre-configured for PHP applications, with gzip compression and security rules.
- .gitignore: Ensures proper exclusion of sensitive or unnecessary files, including dependencies and logs.

---

How to use the template for development:

1. Clone the repository to your machine: `git clone https://github.com/ac1Dmarv3L/docker-php-nginx.git`
2. Go to the directory: `cd docker-php-nginx`
3. Build the images: `docker compose build`
4. Start the containers: `docker compose up -d`

---

Whether you're starting a new project or looking for a robust Docker template, this setup will help you hit the ground running while staying aligned with industry standards.