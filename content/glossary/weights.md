---
subject: 'Machine learning'
term: 'Weights'
---

A neural network is a mathematical function that is extremely flexible and that depends on its weights. Neural networks are powerful tools because they can solve a very wide array of problems just by finding the right weights.

Weights in an AI model are numerical values that define how strongly given inputs to a node or neuron influence its output, in other words, they are the _parameters_ that are learned during the training process.

Using neural networks gives the operator enough flexibility to focus his efforts on training the model, e.g. finding good weights assignments.

Weights are just variables, and a weight assignment is a particular choice of values for those variables. 

The program's inputs are values that it processes in order to produce its results, for instance, taking image pixels as inputs and returning the classification "dog". The program's weight assignments are other values that define how the program will operate.

A traditional program takes input and outputs results, whereas a machine learning program takes inputs and weights to output its results. Another difference is that the _program_ is a set of conditionals, loops, etc. whereas the _model_ is a mathematical function that minimizes errors to improve its accuracy. This function:

  - takes the inputs
  - multiplies them by a set of weights (nowadays called `parameters`)
  - adds them up
  - redoes this process
  - once it's done, it can for instance take all the negative numbers and replace them with 0s (ReLU)
  - it then takes these inputs to a next _layer_ and redoes the whole process

This is how a deep learning model works, in contrast of a more classic program, which does not have weights.

Adjusting the weights here should be done with the goal of maximizing the model's performance. This adjustment can be done automatically.

As you can see, we also differentiate `results` from `performance`. For instance, the results can be the classification of an image, and the performance can be the accuracy of the classification.

At some point, we can decide that a model is trained, that is we've chosen our favorite weight assignment; you will generally include the weights as part of the model at the end of this process. You can also note that a trained model can be treated like any other computer program when the training is over, this leverages powerful APIs. Another thing to note: once the model is trained, predicting (_inference_) is faster than training.  

Weight assignment in deep learning is like giving each input a score that affects how much it influences the output. For example, if you have a neural network that predicts the price of a house based on its size and location, you might give more weight to the size than the location, because size is more important for the price. The weights are usually random numbers at first, but they change as the network learns from the data. The way you choose the initial weights can affect how well the network learns and performs.

One way to choose the initial weights is to use some rules based on the type of function that each node uses to calculate its output. For example, some functions are like switches that turn on or off depending on the input, while others are like curves that smoothly change from low to high. Different rules work better for different functions, so you have to match them accordingly.

A simple way to figure out whether a weight should be increased a bit, or decreased a bit, would be just to try it: increase the weight by a small amount, and see if the loss goes up or down. Once you find the correct direction, you could then change that amount by a bit more, or a bit less, until you find an amount that works well. However, this is slow! As we will see, the magic of calculus allows us to directly figure out in which direction, and by roughly how much, to change each weight, without having to try all these small changes in a loop. The way to do this is by calculating gradients. This is just a performance optimization, we would get exactly the same results by using the slower manual process as well.

Each layer of a neural network has its own set of weights.

