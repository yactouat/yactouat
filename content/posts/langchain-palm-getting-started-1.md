---
excerpt: I've been hearing about both Vertex and Langchain for months now, it's about time I test drive it! 🚘
tags: [ai-apis, llm, gcp, vertex-ai, langchain]
thumbnail_ai_generated: false
thumbnail_img: langchain_palm.png
thumbnail_img_alt: infographic showing the integration of LangChain and PaLM with Vertex AI
title: getting started with LangChain and PaLM on Vertex AI (part 1)
---

[LangChain](https://www.langchain.com/) + [PaLM](https://ai.google/discover/palm2/) on [Vertex AI](https://cloud.google.com/vertex-ai/) => the combination of these tools allows you to create agentic LLMs.

## What you need to use PaLM on Vertex AI

- a GCP account and project with billing enabled
- having enabled Vertex AI API
- a service account that is allowed to use Vertex AI (Vertex AI User role), you ought to have a JSON key file for this service account

## TL;DR: show me the code

Here is what you came from, the code to get started with LangChain and PaLM on Vertex AI: [https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb). 

## What is an agentic LLM?

LangChain is a framework for developing applications powered by LLMs.

With it you can:

- bring external files, databases, other LLMs, applications, access to networks, to LLMs
- allow LLMs to interact with their environment via decision making
- use LLMs to decide which action to take next

When LLMs interact with external systems, they become:

- **data-aware**
- **agentic**, meaning they can understand, reason, and use data to take action in a meaningful way

Among the many things you can do with an LLM augmented with other systems, you can:

- convert natural language to SQL, this is a powerful way of interacting with data-driven applications
- call any integrated webhook with a query formulated in natural language
- synthetize outputs from multiple models, or chain them in a specific order

## What LangChain does

LangChain allows you to glue together the components of your systems augmented with LLMs.

It's architecture favors a modular approach with common patterns that make it easy to build complex applications based on LLMs. Basically, LangChain makes enables models to connect to data sources and agents to make decisions.

The main building blocks of LangChain are:

- **Components**: they are abstractions responsible for bringing external data and systems to LLMs
- **Agents**: these abstractions enable LLMs to communicate with their environment and to take a decision
- **Chains**: they are series of actions that can be executed by an agent
- **Modules**: they are specific function or capability, for instance a sentiment analysis tool
- **Models**: they provide an interface to different type of AI models, 3 models primitives are supported:
    - **LLMs**
    - **Chat Models**
    - **Text Embedding Models**
- **Prompts**: inputs to models, they are typically constructed from multiple components
    - interfaces to construct prompts and work with them are **Prompt Templates**, **Example Selectors**, and **Output Parsers**
- **Memory**: this is a construct for retrieving and
- **Documents** in LangChain refer to unstructured text associated with arbitrary metadata
- **Indexes**: well... they index documents, but seriously, these abstractions are made of:
    - **Document Loaders**
    - **Text Splitters** that chunkify text into smaller pieces
    - **Vector Stores** that store documents as embeddings
    - **Retrievers** that fetch relevant documents

## LangChain and Vertex AI integration

Vertex AI is an integrated machine learning cloud platform that helps you build and run ML projects at scale.

Vertex AI PaLM foundational models(Text, Chat, and Embeddings), are officially integrated with the LangChain SDK.

I've divided [the reference notebook](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb) into key sections, the first one is:

### Setting things up

- importing libraries
- loading environment variables (among them the path to GCP service account JSON key file)
- initializing VertexAI client
- defining a utility function to rate limits calls to the API
- defining a utility class to manipulate Vertex AI embeddings
- instanciating our first foundational text model: `text-bison@002`
- set an instance of the `VertexAIEmbeddings` class to manipulate the embeddings of our model with 100 queries per minutes configured and batches of 5 documents (strings)
- interacting with our LLM

Tonight, I won't go further I think, as I've mostly read what LangChain is all about, and also scrolled on newsfeeds like crazy because Google's Gemini is out! I think now, more than ever, is the perfect timing to start learning how to use Vertex AI and LangChain 😉

## Sources

- [GCP tutorial](https://github.com/GoogleCloudPlatform/generative-ai/blob/main/language/orchestration/langchain/intro_langchain_palm_api.ipynb)