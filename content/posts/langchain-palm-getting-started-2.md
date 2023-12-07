---
excerpt: I've been hearing about both Vertex and Langchain for months now, it's about time I test drive it! 🚘 This is the part 2 of this experiment, in which I play with chat interactions.
tags: [AI-apis, LLMs, GCP, Vertex-AI, LangChain]
thumbnail_img: langchain_palm.png
title: getting started with LangChain and PaLM on Vertex AI (part 2)
---

This article is part 2 of a series of articles related to LangChain + Vertex AI PaLM implementation. You can read the first part [here](https://yactouat.com/posts/langchain-palm-getting-started-1/).

## TL;DR: show me the code

Here is what you came from, the code to get started with LangChain and PaLM on Vertex AI: [https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb). 

I've divided [the reference notebook](https://github.com/yactouat/learning_AI/blob/master/notebooks/langchain-x-palm.ipynb) into key sections, here they are:

## Notebook sections

### Setting things up

(see [previous article](https://yactouat.com/posts/langchain-palm-getting-started-1/))

### Using Chat

This sections shows how to use chat interactions instead of raw text interactions.

In the context of LangChain, chats are different from simple LLM textual interactions because additional role metadata can be added to the text interaction with the model.

The roles that can be configured are:

- **System**: this holds the context that tells the AI what to do
- **Human**: this should hold the messages intended  to represent a user
- **AI**: this holds the messages responded by the AI

I was quite disappointed to find out in [the GCP guide I'm following](https://github.com/GoogleCloudPlatform/generative-ai/blob/main/language/orchestration/langchain/intro_langchain_palm_api.ipynb) that, contrary to what their notebook shows, the chat history is not kept in memory when a new chat interaction is sent... this means you have to do this yourself if you want to keep track of the conversation.

As it happens, it's not hard to do:

- use the `AIMessage` class to store whatever the AI has previously said in the chat dialog
- recall the human message prior to that output on sending the new interaction, this is necessary, as using the `AIMessage` class in LangChain with Vertex works with an odd number of messages (by the way, `SystemMessage` instances are not counted in the number of interactions) => I had a 400 saying exactly that

Implementation of these steps looks like so (skipping the import statements and the rest of the setup in [the notebook](https://yactouat.com/posts/langchain-palm-getting-started-1/)):

```python
chat = ChatVertexAI()

initial_human_message = HumanMessage(
    content="What is the future of AI multi modality?",
)

chat_interaction = [
    SystemMessage(
        content="You are an AI assistant that is specialized in software enginering and in machine learning. Your answers are two short sentences long maximum.",
    ),
    initial_human_message
]

response = chat(chat_interaction)

print(response.content)

response_with_history = chat([
    SystemMessage(
        content="You are an AI assistant that is specialized in software enginering and in machine learning. Your answers are two short sentences long maximum.",
    ),
    initial_human_message,
    AIMessage(
        content=response.content,
    ),
    # AI answered that the future of AI will contain a wider range of data types as inputs
    HumanMessage(content="what wider range of data types?")
])

print(response_with_history.content)
```

Next part that will be tackled is related to embeddings using LangChain and [Vertex AI Embedding API for text](https://cloud.google.com/vertex-ai/docs/generative-ai/embeddings/get-text-embeddings).

See you there! 👋

## Sources

- [GCP tutorial](https://github.com/GoogleCloudPlatform/generative-ai/blob/main/language/orchestration/langchain/intro_langchain_palm_api.ipynb)