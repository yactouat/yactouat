---
subject: 'browser automation'
title: 'Observations on puppeteer'
---

`puppeteer` is a Node.js library that provides a high-level API to control Chrome or Chromium over the DevTools Protocol. It follows the latest maintenance LTS version of Node.

The basic workflow of `puppeteer` is:

- launch/connect to a browser
- create pages
- manipulate pages using Puppeteer's API

If you don't want to download the set of browsers that are included by default in a new `puppeteer` project and manage browsers yourself, you can use the `puppeteer-core` package instead of the `puppeteer` package. If you are managing browsers yourself, you will need to call puppeteer.launch with an an explicit `executablePath`.
