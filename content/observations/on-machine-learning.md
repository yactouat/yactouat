---
subject: 'Machine learning'
title: 'Observations on machine learning'
---

## Datasets

### Dataset evaluation steps

- identify what values are repeated a lot in the dataset
- identify what values are distinct in the dataset
- identify the target class
- evaluate if an imbalance between the target classes may cause an issue in the problem that you are trying to solve
- identify the number of samples and features
- identify continuous and categorical columns
- visually inspect the distribution of data with histograms, a common approach is to identify the peaks and the tails of the distribution
- look at the distribution of values in the categorical columns and assess _fairness_ issues
- run a cross tabulation to identify meaningful relationships between categorical columns, this can be helpful to remove columns that are not useful
- use pair plots to discover interesting correlations over all the features
- confirm these correlations with more precise pair plots including only pairs of supposedly correlated features

### Get to know your dataset

Given a machine learning task, a lot of people would jump right away into the technicalities of the training process and try to put up a model as soon as possible. This is a mistake. One should always understand the business context of the data, the meaning of the features, and the relationships between them in order to build a good model that will actually solve the problem.

### Highly correlated columns

You must be on the lookout for highly correlated columns in your dataset, if you have any of those in your dataset, you should remove a maximum of them. You can do this safely without losing information.

One way to find highly correlated columns is to run a cross tabulation for a given set of columns.

### Test and validation sets

Usually, the test set is missing the variable you want to predict. This is because you want to evaluate the performance of your model on unseen data. As a general rule of thumb, try not to randomize your validation and test sets too much and try to make meaningful splits.

### Validation set

You don't want to randomly remove data from your dataset when dealing with time series. Instead, you should truncate your dataset to only keep the most recent data for the validation set.

## Evaluate a machine learning model

Focus on the human-readable metrics that are important to you rather than on the output of the loss functions.

## Neural networks

### Hyperparameters

#### Batch size

As it happens, we get better generalization if we can vary the contents of the batches during training across epochs. One simple and effective thing we can vary is what data items we put in each batch that is fed to the model. Rather than simply enumerating our dataset in order for every epoch, what we normally do is randomly shuffle it on every epoch, before we the batches.

For instance, the `fastai` `DataLoader` class does just that.

```python
coll = range(15)
dl = DataLoader(coll, batch_size=5, shuffle=True)
list(dl)	
```

```bash
[tensor([ 3, 12,  8, 10,  2]),
 tensor([ 9,  4,  7, 14,  5]),
 tensor([ 1, 13,  0,  6, 11])]
```

#### Number of layers

Adding more layers to model adds more complexity to it; this makes possible to capture more complex patterns in the data, this is particularly useful for tasks that involve intricate patterns or relationships.

Also, deeper models tend to learn more abstract and high-level features (feature hierarchy). For instance, in an image recognition model, early layers might detect edges while deeper layers might recognize shapes or objects.

Deeper models also increase performance. With a deeper model (that is, one with more layers) we do not need to use as many parameters; it turns out that we can use smaller matrices with more layers, and get better results than we would get with larger matrices and fewer layers. We can use a deeper model with less number of parameters, better performance, faster training, and less compute/memory requirements.

If you chose to use a deeper model, you will want to set a lower learning rate and a few more epochs.

### Inputs of neural networks

The datasets that are fed to neural networks often come in the form of lists of tuples, where each tuple is a pair of `input data x, target y`.

Neural networks work better with smaller input. This is why you will often see standardization steps before training.

### Models architecture

#### Non-linearity

Adding nonlinearity to a deep learning model is a fundamental concept that enables the model to learn from the data in a way that is more complex than a mere linear relationship.

In a linear relationship, the output is directly proportional to the input. For instance, we can iteratively adjust the parameters (weights and biases) to find the minimum of the loss function. At each step, we would use a randomly selected batch of data points to compute the gradients of the loss function and update the parameters.

Nonlinear relationships are more complex; the output does not change in a direct proportion to the input.

In the context of deep learning, we often want our models to learn from the data in a way that captures these more complex, nonlinear relationships. This is where the concept of adding nonlinearity comes in.

This is typically done by introducing nonlinear _activation functions_ in the model.

Examples of common activation functions that can add non-linearity to a model are _sigmoid_ and _ReLU_.

Nonlinear activation functions allow each layer in the network to transform the data in a nonlinear way, enabling the model to learn from the error and make adjustments to the layer’s weights during back-propagation, thus allowing the learning of complex patterns.

Let's relate this to a simple scenario. Imagine you are trying to predict the price of houses. If you only consider the size of the house (square feet), you might have a linear relationship. However, house prices are affected by many factors in complex ways, such as location, age, condition, etc. By introducing nonlinearity to your model, you are enabling it to capture these complex relationships and make better predictions.

In fact, it can be mathematically proven that such a model can solve any computable problem to an arbitrarily high accuracy, if the model is large enough with the correct weights. This is known as the _universal approximation theorem_.

### Overfitting

You can detect that a model overfits when the model performs increasingly well on the training set but does the opposite on the validation set.

## NLP

When training a model for an NLP task, don't hesitate to concatenate several variables to create a meaningful input document. When you do so, you should use delimiters to separate the different variables.

### Tokenization with numericalization

Once you have valid documents, you will want to split these documents into tokens, which are basically words. When this is one, you will have a list of all the unique words in your dataset. This is called the _vocabulary_. Every one of these unique words will be assigned a number (basically an index). You can also tokenize text using _subwords_.

Before you start tokeninzing your text, you will want to chose what pretrained model to use, in order to use the same vocabulary as the pretrained model. When doing that, the tokenization and numericalization steps will be done for you.

The bigger the vocabulary, the more memory you will need to train your model.

Afther the tokenization step, you will move on to the numericalization step. This is where you convert each token into a number.

The tokenization + numericalization approach differs from vector embeddings. The former results in highly dimensional one-hot encoded vectors while the latter results in lower dimensional but more dense vectors.

Tokenization + numericalization work better with simpler NLP tasks or when computational resources are limited.

### Vector embeddings

_Vector embeddings_ represent tokens as vectors in a continuous vector space (values within a range, not just integers). This is a way to represent words as numbers in a fine-grained and nuanced placement within a vector space. In NLP, words are represented as vectors of real numbers of high dimensionality (200 or 300 dimensions for instance).

The value of these vectors, randomly set at first, has been set through training on large datasets of text data. The basic idea is that words appearing in similar contexts tend to have similar meanings. The high dimensionality of the vectors allows to capture different aspects of semantic relationships between words. Each dimension encodes some aspect of meaning, but interpreting individual dimensions is not straightforward.

_Contextual embeddings_ go a step further by creating vecors for words based on their specific context within a sentence. This allows for more nuances in understanding the semantic meaning of words.

Vector embeddings are suited for complex tasks requiring understanding of context and semantics.

