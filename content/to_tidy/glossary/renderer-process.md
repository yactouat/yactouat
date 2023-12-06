---
subject: 'Electron'
title: 'renderer process'
---

Each web page your Electron app displays in a window will run in a separate process called a _renderer_ process (or simply _renderer_ for short). Renderer processes have access to the same JavaScript APIs and tooling you use for typical front-end web development, such as using webpack to bundle and minify your code or React to build your user interfaces.

Renderer processes are responsible for displaying graphical content.

You can load a web page into a renderer by pointing it to either a web address or a local HTML file. Renderers behave very similarly to regular web pages and have access to the same web APIs.

Renderer processes do not run Node.js by default for security reasons.