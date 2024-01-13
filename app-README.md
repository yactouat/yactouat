# yactouat.com app' readme

## What is this ?

This repo holds both my GitHub profile README and my personal website: https://yactouat.com.

## Pre requisites

- a GCP project with billing and Cloud Storage enabled:
    - with a bucket
    - a SA with a JSON credentials key named `gcp-storage-creds.json` at the root of the repo
    - the SA must have role 'Storage Object User'

## How to run locally

Everything is dockerized, but you need to start the stack with `sh ./start.sh` to enable debugging.

To open a shell within the PHP app' container, just run:
    
```bash
docker compose exec php-apache bash
```

To enjoy the modern tooling of your IDE, you might need to run outside the container:

- `sudo apt install php-curl php-xml` (you should have PHP CLI installed)
- `composer install`

## CI / CD

Pushing to the main branch will trigger a Google Cloud Run revision deployment (cf. `.github/workflows`).

- for the deployment of this app', a VPS is provisioned running Ubuntu 22.04
- run at least once on remote server, in this order =>

```bash
    # as `root`
    adduser yactouat
    usermod -aG sudo yactouat
    ufw allow OpenSSH
    ufw enable
    sudo nano /etc/ssh/sshd_config # change port to whatever you want, don't forget to update repo secrets
    # ! at this point, your SSH key should have been registered in the remote server
    sudo ufw delete allow OpenSSH
    sudo ufw allow PORT/tcp
    sudo systemctl restart ssh
    apt install -y php libapache2-mod-php curl redis-server php-curl php-xml php-mbstring
    nano /etc/redis/redis.conf # change `supervised no` to `supervised systemd`
    su postgres
    cd ~ 
    psql -U postgres
    ALTER USER postgres WITH ENCRYPTED PASSWORD 'PASSWORD';
    CREATE SCHEMA public; # may already exist

    # as `yactouat`
    <!-- TODO install Apache part -->
    sudo apt update && sudo apt upgrade -y
    sudo apt install apache2 -y
    sudo ufw allow in 'Apache Full'
    # you should be able to navigate to the IP using plan HTTP and see the Apache default page
    apt install php8.1-pgsql
    phpenmod pdo_pgsql
    systemctl restart apache2
    sudo chown -R $USER:$USER /var/www/html
    sudo nano /etc/apache2/sites-available/yactouat.com.conf # copy the contents of `Docker/conf/apache.conf`
    sudo a2enmod rewrite
    sudo a2enmode headers
    sudo a2ensite yactouat.com
    sudo a2dissite 000-default
    cd /var/www/html && rm index.html

    # from local machine
    ssh-copy-id -p PORT yactouat@HOST # then check in ~/.ssh/authorized_keys what keys you want to keep in there
    scp -P PORT gcp-storage-creds.json yactouat@IP:/var/www/html/
```

- then updates are made via Github Actions (check out necessary secrets in repo settings by looking at the workflow files)
