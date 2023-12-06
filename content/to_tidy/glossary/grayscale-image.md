---
subject: 'image processing processing'
term: 'grayscale image'
---

Images can be represented as arrays, with pixel values representing the content of the image.

For greyscale images, a 2-dimensional array is used with a range of 256 integers.

A value of `0` represents black, and a value of `255` represents white. Each value in between represents a shade of grey.

For RGB images, you would use 3 color channels, one for each color, with separate 256-range 2D arrays used for each color. In this case, 0 will always represent white. The 3 2-D arrays form a final 3-D array (rank-3 tensor) representing the color image.