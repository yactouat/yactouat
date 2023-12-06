---
subject: 'Next.js'
title: 'Observations on Next.js'
---

By default, the `Link` component enables client-side navigation in development mode. Client-side navigation means that the page transition happens using JavaScript, which is faster than the default navigation done by the browser.

However, in production mode,  whenever `Link` components appear in the browser’s viewport, Next.js automatically prefetches the code for the linked page in the background. By the time you click the link, the code for the destination page will already be loaded in the background, and the page transition will be near-instant!
