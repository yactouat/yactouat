---
excerpt: so yeah, I want to predict stuff, here are some notes I took along the way, mainly about windowing 🪟
is_published: false
tags: [tabular, ai]
thumbnail_ai_generated: true
thumbnail_alt_text: tabular data predictions illustration
thumbnail_img: tabular-data-preds.png
title: time series forecasting notes
---

<!-- TODO introduction -->

## Windowing

When you want to make predictions into the future, you need to use a windowing technique, that is to say make set of predictions on a window of consecutive data points.

There are two types of windows in time series forecasting:

- input windows: it's the range of consecutive data points from the past you use to predict future data points; for instance, an input window of one week would mean that you use the data from the past week to make a prediction for the future
- label windows: the range of consecutive data in the future that is to be predicted; for instance, a label window of three days would mean that you're trying to predict a value for the next three days

When you're training a deep learning model for time series forecasting, you would typically slide these windows across your dataset to create many examples for training. This is a process known as _windowing_. Each training example would consist of an input window (_features_) and a label window (_target_). The choice of window sizes can significantly impact the quality of the model.

Here are some general principles governing window sizes selection:

- they should reflect the cycle of the data; for instance, if the data shows weekly patterns, then a window size of seven days would be a reasonable choice
- the more data, the more granularity, the more subtle patterns you may uncover, but beware that it adds more noise and risk of overfitting
- you should not keep older data if it's not relevant anymore
- set your forecasting window to be actually relevant: does it solve a business problem? does it help you make a decision?
- shorter windows are more accurate than longer ones

The main features of an input window are:

- its width (number of data points, or _time steps_)
- the time offset between the time steps
- which features are used as inputs, labels, or both

### Windowing in practice

The `WindowGenerator` class in TensorFlow is a convenient way to:

- create windows for training, validation, and testing
- split windows of features in to inputs and labels pairs

<!-- TODO more on that -->

## Single and multi-step forecasting

When you're making predictions into the future, you can choose to give context for the current values of the model's inputs, e.g. allow it to see how features change over time.

Multi-step inputs allow to take multiple inputs to produce a single output. This is a perfect use-case for _convolutional neural networks_ (CNNs).

<!-- TODO more on that -->

## LSTMs

LSTMs can process longer sequences effectively.

<!-- TODO more on that -->

## Sources

- [TensorFlow tutorial on time series forecasting](https://www.tensorflow.org/tutorials/structured_data/time_series)
