---
excerpt: Final part of the notes I've been taking test-driving 🚘 Langchain using GCP's Vertex AI APIs; I'm probably tired because my productivity is quite low and this test-drive is starting to become a road trip 🛣️ ... but hey better slow and steady than doing nothing at all right ? Let's dive in again, this time starting with example selectors and working our way through output parsers, document loaders, text splitters, etc. And we'll of course finish with chains! ⛓️
tags: [ai-apis, llm, gcp, vertex-ai, langchain, web-scraping]
thumbnail_ai_generated: false
thumbnail_img: langchain_palm.png
thumbnail_img_alt: infographic showing the integration of LangChain and PaLM with Vertex AI
title: getting started with LangChain and PaLM on Vertex AI (part 4)
---

This article is part 4 of a series of articles related to LangChain + Vertex AI PaLM implementation. You can read the third part [here](https://yactouat.com/posts/langchain-palm-getting-started-3/).

## TL;DR: show me the code

Here is what you came from, the code to get started with LangChain and PaLM on Vertex AI: [https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb). 

I've divided [the reference notebook](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb) into key sections, here they are:

## Notebook sections

### Setting things up

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-1/))

### Using Chat

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-2/))

### Embeddings basics

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-3/))

### Prompt templates

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-3/))

### Example selectors

Example selectors are a tool that help you implement few shot prompting in a structured way.

As a reminder, few shot prompting is a technique that allows you to leverage the pre-trained knowledge of the LLM to perform a task with a small amount of additional training, provided via examples in the prompt.

This technique can be used:

- when the type of required output is difficult to describe
- when very specific data that the model does not know about is required
- when you want to direct the output of the LLM towards a specific format
- when you want to direct the _self-ask_ mechanism of the LLM towards a specific thought process

Langchain docs [presents example selectors](https://python.langchain.com/docs/modules/model_io/prompts/example_selectors) as a tool to select which examples to include in the prompt

Example selectors work by:

- defining a set of examples as a dictionary of questions/answers
- plug in an example selector in the prompt
- this example selector will then select the most relevant example to include in the prompt using vector similarity; at this point you have chosen a vector store and an embedding model
- you can then use the selected example in the prompt

### Output parsers

Output parsers are a tool that help you format the output of the LLM in a structured way, for instance JSON. The steps to create an output parser are:

- define a `ResponseSchema` objects list
- these objects contain the name of the key in the output and a description of what should be under this key
- you then create a parser object from the `ResponseSchema` objects list, this will act as the formatting instructions
- using a prompt template, you can then inject the formatting instructions in the prompt, for instance for Q&A answer in terms of pros and cons (example in the notebook)
- this prompt template can than be used to generate the output
- with the parser object, you can now extract a JSON (or whatever format you want) from the output and use it in any system that can read your format

Output parsers are very powerful tool that allow you to use the flexibility of LLMs to create structured objects that can be consumed by more traditional systems seamlessly.

### Document loaders

Document loaders are LangChain abstractions that provide you with the tools to load documents from various sources (csv, file directory, HTML, etc.). They make it easy to conceive tasks that were previously quite tedious, like scraping a website for instance.

I've also discovered this website: https://llamahub.ai/?tab=loaders, which is a basically a repository of document loaders for LangChain. You can connect quite a lot of stuff (for instance your Google Calendar), and I now feel dizzy with all the possibilities 🤯 !

I've tried the `WebBaseLoader` and it takes litteraly 3 lines of code to scrape any page:

```python
from langchain.loaders import WebBaseLoader
# other libs to import + setup

loader = WebBaseLoader("https://reboot-conseil.com/") # where I work these days
data = loader.load()
data
```

### Text splitters

As their name implies, _text splitters_ are a tool that help you deal with tokens limitations when using LLM APIs. For instance, when you load a web page (as in our previous example), you may end up with a lot of tokens, and you may want to split the text into smaller chunks to avoid hitting the token limit. A short demo is available in the notebook, right after the documents loader part.

### Retrievers

LangChain _Retrievers_ act as an interface to return documents given an unstructured query. Vector stores can be used a backbone for these retrievers, but there are other types of retrievers as well. As previously, you have a demo in the notebook.

### Vector stores

Now that we can load data, split it, and retrieve it; we want to persist it ! This is where vector stores come into play. In the notebook I'm just showing how to store the embeddings and get them back.

You would want to persist embeddings to give your users a high quality search feature, for instance.

### Memory

_Memory_ is a LangChain abstraction that deals with a common issue related to LLM-based applications: keeping the history of the conversation during the interaction. It's basically keeping the state of the conversation up. In the notebook, we do this in memory but you have more long-term solutions as well. It is also my first interactions with **Chains**, which are a central concept in LangChain: it's about combining different LLM calls and action automatically.

### Chains

Chains a very powerful concept that allows you to create complex interactions with the LLM without having to write a lot of code. It uses the **LCEL** (LangChain Expression Language) to define the interactions.

We'll do 3 types of chains in the notebook:

- one sequential chain
- one summarization chain
- one question answering chain

#### Sequential chain

Making a series of calls to LLMs is particularly useful when you to take the output from one call and use it as the input for another call. I provide a toy example in the notebook, in which I ask a LLM to set the synopsis for a children story, and then I ask the LLM to give a darker atmosphere to this story.

#### Summarization chain

All knowledge workers need to summarize documents at some point, these documents can come from various sources. LLMs are a tool of choice as they dramatically augment the productivity of summarization tasks.

A central question, when building LLM-augmented summarizers, is to pass documents into the LLM's context window without overflowing the token limit. We'll browse two related websites and use their contents to iteratively refine a summary.

#### Question answering chain

The purpose of this chain is to do QA over a set of documents.

This chain leverages RAG (Retrieval-Augmented Generation) to perform QA over a set of documents. RAG is a technique that combines a retriever and a generator to perform QA. The retriever is used to select the most relevant documents, and the generator is used to generate the answer.

The example in the notebook builds up on the scraped websites documents from the previous example.

That's it folks, now you're able to write your own chains and use LangChain to augment your productivity and your applications!

See you there! 👋

## Sources

- [GCP tutorial](https://github.com/GoogleCloudPlatform/generative-ai/blob/main/language/orchestration/langchain/intro_langchain_palm_api.ipynb)
- [LangChain docs](https://python.langchain.com/docs/)
- [Vertex AI Embedding API for text docs](https://cloud.google.com/vertex-ai/docs/generative-ai/embeddings/get-text-embeddings)