---
subject: 'Machine learning'
term: 'learning rate'
---

The _learning rate_ is the number by which you multiply the gradients in a gradients descent.

Deciding how to change our weights based on the values of the gradients is an important part of the deep learning process. Nearly all approaches start with the basic idea of multiplying the gradient by some small number, called the learning rate (LR). The learning rate is often a number between 0.001 and 0.1, although it could be anything.

Deciding which learning rate to use is a trial and error process. If you make it too big, your model will diverge, which means it will get worse and worse. But if you make it too small, the model will eventually improve, but it will take forever to converge.

The _learning rate_ is a hyperparameter: it controls how much the program adjusts its parameters in response to the feedback it gets. To understand with an analogy:

- imagine a robot trying to learn how to walk
- the learning rate would be the size of the steps the robot takes
- if the steps are too wide, the robot will fall (overcorrecting)
- if the steps are too small, the robot will take a long time to learn and hardly make any progress (undercorrecting)

Here is a visual representation of an undercorrecting model:

![undercorrecting model](https://raw.githubusercontent.com/fastai/fastbook/823b69e00aa1e1c1a45fe88bd346f11e8f89c1ff//images/chapter2_small.svg)

And here are some overcorrecting models examples:

![overcorrecting model](https://raw.githubusercontent.com/fastai/fastbook/823b69e00aa1e1c1a45fe88bd346f11e8f89c1ff/images/chapter2_div.svg)

![overcorrecting model](https://raw.githubusercontent.com/fastai/fastbook/823b69e00aa1e1c1a45fe88bd346f11e8f89c1ff//images/chapter2_bouncy.svg)

... as you can see, the first one makes steps that are too big, resulting in a lousy performance, and the other bounces back and forth because of a step that may be a little too high, this would cause training to be very slow.