---
subject: 'Machine learning'
term: 'Stochastic Gradient Descent'
---

Stochastic Gradient Descent (SGD) is a method to minimize the loss function in a machine learning model by iteratively moving the weights of the model in the direction that locally decreases the loss function the most, which is the negative of the gradient.

The key idea behind SGD (and many optimization algorithms, for that matter) is that the gradient of the loss function provides an indication of how that loss function changes in the parameter space, which we can use to determine how best to update the parameters in order to minimize the loss function.

SGD is an optimization algorithm.

The 7 steps of this algorithm are:

1. Initialize the weights (_parameters_) of the model with random values.
2. Calculate predictions for a batch of data.
3. Calculate the loss function for the batch.
4. Calculate the gradient of the loss function with respect to the weights. This is an approximation of how the parameters need to change in order to minimize the loss function.
5. Update the weights (_stepping_ them) by moving them in the direction of the negative of the gradient.
6. Repeat steps 2-5 until the loss function is minimized.
7. Use the model to make predictions.

This pseudo-code shows the basic steps taken for each epoch in SGD:

```
for x,y in dl:
   pred = model(x)
   loss = loss_func(pred, y)
   loss.backward()
   parameters -= parameters.grad * lr
```