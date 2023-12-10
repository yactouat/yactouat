---
excerpt: Part 3 of the bits and pieces of me test-driving 🚘 Langchain using GCP's Vertex AI APIs; this time, we'll start with text embeddings and go on with prompt templates.
tags: [AI-apis, LLMs, GCP, Vertex-AI, LangChain, agents]
thumbnail_ai_generated: false
thumbnail_img: langchain_palm.png
thumbnail_img_alt: infographic showing the integration of LangChain and PaLM with Vertex AI
title: getting started with LangChain and PaLM on Vertex AI (part 3)
---

This article is part 3 of a series of articles related to LangChain + Vertex AI PaLM implementation. You can read the second part [here](https://yactouat.com/posts/langchain-palm-getting-started-2/).

## TL;DR: show me the code

Here is what you came from, the code to get started with LangChain and PaLM on Vertex AI: [https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb). 

I've divided [the reference notebook](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb) into key sections, here they are:

## Notebook sections

### Setting things up

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-1/))

### Using Chat

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-2/))

### Embeddings basics

_Embeddings_ are a way to represent any kind of data (text, images, videos, etc.) as vectors of numbers.

As a reminder, a _vector_ is a mathematical object that holds a list of numbers in a matrix, it has a _magnitude_ (or measure of its length) and a _direction_ (where the vector points). In a 2-dimensional space for instance, a vector is represented with numbers, as in `[x, y]`; these coordinates would tell us where the endpoint of the vecot if we were to start from the origin of the space `(0, 0)`. So vectors are essentially a way to represent points in space.

In deep learning models, including LLMs, data is often represented as vectors that have many more than 2 or 3 dimensions. For instance, the [BERT](https://arxiv.org/abs/1810.04805) model uses 768 dimensions to represent words. When we create embeddings, we represent data into highly-dimensional vectors, and we can use these vectors to compare data points.
The position of each vector (or point) is significant in the context of LLMs, as vectors close to each other tend to have similar meanings (and vice-versa). This is so because these models were trained with a given context (e.g. a corpus of text) and they learn to represent words in a way that is meaningful to the context they were trained on.

In practice, with high-dimensional vectors, you wouldn't mesure the distance between points using Euclidian distance, but rather cosine similarity. The main reason for this is that cosine silmilarity is _scale-invariant_, meaning that it doesn't matter how big the vectors are, the cosine similarity between them will always be the same since it only cares about angles between vectors. The notebook section provides an example using the two methods.

In this section, I've used the [Vertex AI Embedding API for text](https://cloud.google.com/vertex-ai/docs/generative-ai/embeddings/get-text-embeddings) to get embeddings for a given text. The API is very simple to use, you just need to provide a text and the API will return the vector representation of the text. I also play a bit by comparing Euclidian distance and cosine similarity between vectors between 3 sentences, with one being completely unrelated to the other two.

Also, one thing I've discovered is that Vertex AI now supports multimodal embeddings (text + image) out of the box! 🤯 That will probably a topic for another article.

### Prompt templates

This section presents a very straightforward abstraction and easy to use abstraction to manipulate template prompts, which can be very useful if I want to direct the output that is presented to your users to be more relevant to your use-case, for instance.

That's it folks, next article we'll tackle example selectors, which are how you can set up few shot prompting in LangChain.

See you there! 👋

## Sources

- [GCP tutorial](https://github.com/GoogleCloudPlatform/generative-ai/blob/main/language/orchestration/langchain/intro_langchain_palm_api.ipynb)
- [LangChain docs about Vertex AI embeddings](https://python.langchain.com/docs/integrations/text_embedding/google_vertex_ai_palm)
- [Vertex AI Embedding API for text docs](https://cloud.google.com/vertex-ai/docs/generative-ai/embeddings/get-text-embeddings)