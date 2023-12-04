---
subject: 'Prompt engineering'
title: 'Observations on prompt engineering'
---

According to Bloomberg, some people are paid over 335000$ to write good prompts.

## History of LLMs

- 1964: Joseph Weizenbaum creates ELIZA, a chatbot that mimics a psychotherapist by using pattern matching techniques and transformation rules (for instance, turning affirmative sentences into questions)
- 1968: Terry Winograd creates SHRDLU, a chatbot that can manipulate blocks in a virtual world
- 2018: GPT-1 emerges, trained on a large corpus of text from the internet and human knowledge
- 2020: GPT-3 popularizes the use of LLMs for a wide range of tasks

## Linguistics are the key to prompt engineering

Linguistics involve several subfields, including:

- computational (the study of language from a computational perspective)
- historical (the study of language change over time)
- morphology (how words are formed)
- phonetics (how sounds are produced and perceived)
- phonology (how sound patterns and changes occur within a language)
- pragmatics (the study of language in context)
- psycholinguistics (the study of language acquisition and comprehension)
- semantics (the study of meaning in language)
- sociolinguistics (the study of the relation of language to society)
- syntax (the study of sentence structure)
- ...

Understanding the nuances of language and how it is used in different contexts is key to effective prompt engineering.

## Make use of the interactivity of the LLM you're using

Instead of asking the chatbot to do a single task and risk having poor results, you should:

- specify the role of the chatbot in the prompt
- specify how it should reply
- specify the goal of the prompt
- specify whatever constraints your task has
- invite the chatbot to followup on its previous answer

## The components of a good prompt

- adopt a persona
- avoid leading the answer
- clear instructions
- limit the scope
- specify the format

### Adopt a persona

- specify who the bot should be writing as

### Clear instructions

This often involves:

- adding more details to the query
- not assuming the IA knows what you are talking about

### Specify the format

Examples of format specification:

- tell the bot what kind of text you want it to generate (for instance, a checklist)
- "use bullet points", "make sure each point is no longer than 10 words"

## The prompt engineer mindset

The goals and principles of the prompt engineer are:

- be explicit about what you want
- build on previous conversations
- don't waste time
- don't waste tokens


## Zero-shot vs few-shot prompting

### Few-shot prompting

It leverages the pre-trained knowledge of the LLM to perform a task with a small amount of additional training, provided via examples in the prompt.

This technique generally involves very specific data that, for instance GPT-4, does not know about.

### Zero-shot prompting

It leverages the pre-trained knowledge of the LLM to perform a task without any additional training.
