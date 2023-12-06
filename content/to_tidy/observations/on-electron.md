---
subject: 'Electron'
title: 'Observations on Electron'
---

When your end-user installs your Electron app on their computer, the installer will embed its own Node.js runtime: this means the user does not need to have Node.js installed on their computer to run your app.

If you need your Electron app' to behave differently based on the platform, just check against `process.platform` variable.