---
subject: 'Machine learning'
term: 'gradients'
---

Gradients represents the slope of a function. It is the value of the derivative of a function at a given point.

A gradient represents, for each weight, how changing the weight would change the loss.

The gradients tell us how much we have to change each weight to make a deep learning model perform better.

Calculating gradients allows to _step_ the weights at each training epoch in the direction that reduces the loss.

The gradients only tell us the slope of a function, but they don't tell us how we should adjust our weights. However they give us useful indications:

- if the slope is very large, then that may suggest that we have more adjustments to do
- if the slope is very small, then that may suggest that we are close to the optimal value

Adjusting the weights of a model can be expressed as simply as:

```python	
weights -= gradient * learning_rate
```

This is what _stepping the weights_ actually means.

We use a substraction here to allow for:

- in case the slope is positive, the weight to be decreased
- in case the slope is negative, the weight to be increased

Remember: our ultimate goal is to minimize the loss.

Gradients are a measure of how the loss function changes with small tweaks to the weights.

_Gradient descent_ is basically taking a step in the directions opposite to the gradients to make the parameters of the model better (e.g. reducing the loss).