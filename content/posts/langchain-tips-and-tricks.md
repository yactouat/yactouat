---
excerpt: LangChain ⛓️ tips and tricks ! 🤓 Here are a few useful things gathered from the docs and my own experiments that are not lengthy enough to deserve their own article.
is_published: false
tags: [langchain, llm, agentic]
thumbnail_ai_generated: false
thumbnail_alt_text: LangChain logo
thumbnail_img: langchain.png
title: langchain tips and tricks
---

What's on the menu today? 🤔

- stop sequences

Don't mind if the list is short, I'm just getting started 😅 I'll update this article as I go.

## Stop sequences

```python
chain = prompt | model.bind(stop=["\n"])
```

This simple trick will make your agent stop generating text when it encounters a newline character. Pretty handy !

## Sources

- [LangChain prompt + LLM cookbook](https://python.langchain.com/docs/expression_language/cookbook/prompt_llm_parser#prompttemplate-llm)