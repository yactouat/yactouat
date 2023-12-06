---
subject: 'Machine learning'
title: 'One-hot encoding'
---

_One-hot encoding_ is a method used in data processing, especially in machine learning and natural language processing (NLP), to convert categorical data into a numerical form.

The encoding process:

- identifies the unique values in the categorical column
- creates binary vectors for each category of length equal to the number of unique values
- each vector has a 1 in the position corresponding to the category and 0 in all the other positions

One-hot encoded vectors are sparse (mostly zeros) and high-dimensional, especially when the number of categories is large.

One-hot encoding does not imply any order or hierarchy between categories. Each category is equally distant from all others in this representation. It does not capture any information about relationships or similarities between categories.