# yactouat.com

## What is this ?

This repo holds both my GitHub profile README and my personal website: https://yactouat.com.

## How to run locally

Everything is dockerized, but you need to start the stack with `sh ./start.sh` to enable debugging.

To open a shell within the PHP app' container, just run:
    
```bash
docker compose exec php-apache bash
```

To enjoy the modern tooling of your IDE, you might need to run outside the container:

- `sudo apt install php-curl php-xml` (you should have PHP CLI installed)
- `composer install`

## CI/CD

Pushing to the main branch will trigger a Google Cloud Run revision deployment (cf. `.github/workflows`).
