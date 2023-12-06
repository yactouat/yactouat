---
subject: 'Machine learning'
term: 'Neural Network'
---

A neural network is like a virtual brain that helps computers learn from data. Just like how our brain has neurons connected by synapses, a neural network has "artificial neurons" connected in layers. When you feed it some information, it goes through these layers to produce an output. The more it practices with data, the better it gets at tasks like recognizing images or making predictions.

## Components of a neural network

### Input layer

The first layer of the network receives the data you want the network to learn from. For example, if you're teaching the network to recognize handwritten digits, each artificial neuron in the input layer could represent one pixel of an image of a digit.

### Output layer

This layer provides the final output. For example, it might tell you which digit the network thinks is in the image.

### Hidden layers

These are layers between the input and output layers. They perform computations and transformations on the data. These layers are where much of the "learning" happens.

### Connections

Each artificial neuron is connected to neurons in the next layer. These connections have "weights," which adjust as the network learns. The weights are like the strength of the connections.

### Activation function

Each neuron has a function that decides how much signal to pass forward based on the input it gets. This is analogous to how a neuron in your brain fires or not based on the signals it receives.

## Main steps of learning

### Forward propagation

The network takes in data and passes it through the layers to produce an output. This is called forward propagation.

You start by giving the input layer your data. This data moves through the hidden layers, getting transformed along the way by the weights and activation functions, until it reaches the output layer.

### Calculate the error

The network compares its output to the correct answer and calculates the error. This is the difference between the network's output and the correct answer.

### Backpropagation

The network uses the error to adjust the weights of the connections. This is called backpropagation (for instance SGD).

 The error is used to adjust the weights in the network, starting from the output layer and moving back toward the input layer. This process helps the network learn.

### Repeat

The network repeats this process until it's learned as much as it can from the data. This is called an epoch. The more epochs the network goes through, the more it learns.

Think of a neural network like a student. The forward pass is like taking a test, calculating the error is like seeing what questions were missed, and the backward pass is like studying to do better next time.
