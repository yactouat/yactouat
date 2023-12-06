---
cheat-sheet: 'Install Nvidia drivers'
subject: 'Ubuntu'
---

When installing Ubuntu, don't bother selecting "install third-party drivers" and enroll a MOK key when installing Ubuntu, there's a possibiliy you won't even see the Nvidia drivers in the "Additional Drivers" tab of the "Software & Updates" app, you can install them manually:

```bash
sudo apt update && sudo apt upgrade
sudo apt install nvidia-driver-<version-number> # you can get the version you need at https://www.nvidia.com/download/index.aspx
```

You should then reboot your computer. After that: 

- running `nvidia-settings` in your terminal should allow you to see the Nvidia settings app
- running `nvidia-smi` in your terminal should show you the Nvidia GPU information
- the Ubuntu system information in your settings app ("About" section) should show your Nvidia GPU

At some point you will want to install the CUDA toolkit, you can do this [here](https://developer.nvidia.com/cuda-downloads?target_os=Linux&target_arch=x86_64&Distribution=Ubuntu&target_version=22.04&target_type=deb_local).