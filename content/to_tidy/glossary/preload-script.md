---
subject: 'Electron'
title: 'preload script'
---

A _preload script_ is a script that **augments** a renderer's features by adding sandboxed Node.js context to it.

Preload scripts are injected before a web page loads into the renderer.

To add features to your renderer that require privileged access, you can define global objects through the `contextBridge` API.