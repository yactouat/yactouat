---
cheat-sheet: 'Install Docker'
subject: 'Docker'
---

Installation steps for Docker and Docker Compose

## on Ubuntu 22.04.03

```bash
# Add Docker's official GPG key:
sudo apt-get update
sudo apt-get install ca-certificates curl gnupg
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg

# add the repository to Apt sources:
echo \
  "deb [arch="$(dpkg --print-architecture)" signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  "$(. /etc/os-release && echo "$VERSION_CODENAME")" stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update

# installing Docker per say
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# starting and enabling Docker
sudo systemctl start docker
sudo systemctl enable docker
sudo systemctl status docker

# add current user to Docker group (you will need to login/logout)
sudo usermod -aG docker $USER

# test that everything works
docker run hello-world
docker ps
```