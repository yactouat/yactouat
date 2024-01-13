---
excerpt: yeap I'm in the rabbit hole again 🐰 🕳️, and I think I will be there for a while given how fascinating is LangChain's approach to AI. In this article, I'm documenting how I've learned to interact with the DB for more advanced tasks, such as generating SQL scripts and saving them using functions for I/O ⛓️
is_published: false
tags: [langchain, llm, agentic]
thumbnail_ai_generated: false
thumbnail_alt_text: LangChain logo
thumbnail_img: langchain.png
title: langchain io with functions and database
---

## Function calls

### The basics

This is the first example a function call I found [in the docs of LangChain](https://python.langchain.com/docs/expression_language/cookbook/prompt_llm_parser#attaching-function-call-information) =>

```python
functions = [
    {
        "name": "joke",
        "description": "A joke",
        "parameters": {
            "type": "object",
            "properties": {
                "setup": {"type": "string", "description": "The setup for the joke"},
                "punchline": {
                    "type": "string",
                    "description": "The punchline for the joke",
                },
            },
            "required": ["setup", "punchline"],
        },
    }
]
chain = prompt | model.bind(function_call={"name": "joke"}, functions=functions)
chain.invoke({"foo": "bears"}, config={})
# AIMessage(content='', additional_kwargs={'function_call': {'name': 'joke', 'arguments': '{\n  "setup": "Why don\'t bears wear shoes?",\n  "punchline": "Because they have bear feet!"\n}'}}, example=False)
```

The docs do a good job at explaining how to use this feature, but it was not very practical for my use-case...

### My function call use-case

I already have an agent that does Q&A on a database, the agent is served by LangServe. It does a fine job at answering questions about the contents of the database, the data structure, etc. So basically, it's a read-only agent. Here is my thought-process:

However I want it to also:

- whenever the intent of updating the database (create, update, delete) is detected, I want the agent to generate a query
- this query needs to be saved in disk to be run as is by the user against the database
- the link to the query script needs to be returned to the user in the bot's response

This is step 1, later I want to:

- upload a file to the agent and add a request related to what's in that file, for instance "with this CSV, migrate all the data to the database"
- instead of consuming precious Vertex AI or OpenAI tokens (if I end up not using `codellama`), I'd like it to generate a query with placeholders for the data to insert in a runnable Python file
- the generated code should handle errors coming from the input and should be ran in a loop until all the data is inserted

I have no clue how to do that yet, but I'm sure I'll figure it out ! The only intuition that I'm having right now is that I will need functions for I/O, at the very least.

Anyway, before even reaching to step 1, I've figured => the agent needs to know what the database looks like, currently, the SQL assistant I've previously buit while writing does give a very lengthy, and frankly not very useful, [technical description of the database](https://github.com/yactouat/langchain-research-assistant/blob/3b0ebd54fab9ccf365ef15664250502620ed76ae/functions.py#L74-L75)... I want the agent to be focused on the business value of the database to maximize the efficiency of my prompts, and not the system tables and other underlying PostgreSQL objects.

Here is the function, plugged into a chain, that allows the agent to be aware of the database, not very satisfying, this is what we'll change in step 0:

```python
def get_postgre_db_schema():
    return exec_static_sql_query("""SELECT
        table_name,
        column_name,
        column_default,
        data_type,
        is_nullable
        FROM information_schema.columns
        WHERE table_schema = 'public'""")
        # this outputs a very horrible thing to read, even for a LLM
```

What I have in mind for step 0 is: 

- to simply use the document parser that already exists in [my research assistant repo](https://github.com/yactouat/langchain-research-assistant/blob/3b0ebd54fab9ccf365ef15664250502620ed76ae/chains.py#L123) to parse whatever SQL files migrate the database
- to store the result of this parsing into the database itself, in terms that an LLM can easily understand
- then I'll update the database reflection function to use the generated description of the database to be able to generate better queries when given natural language input

I like this reflective approach, it's very meta, and it's a good way to make sure that the agent is always up-to-date with the database. Moreover, it can be scripted to be updated with migrations for instance. In other words, it's a good way to make sure that the agent is always aware of the underlying data structure by bootstrapping every chain that requires a database interaction with this database description.

#### Step 1

##### intent detection and query generation

<!-- TODO -->

<!-- TODO step 2 -->

<!-- TODO CTA to register and leave a comment -->

## Sources

- [LangChain prompt + LLM cookbook](https://python.langchain.com/docs/expression_language/cookbook/prompt_llm_parser#prompttemplate-llm)
- [LangChain use of multiple chains](https://python.langchain.com/docs/expression_language/cookbook/multiple_chains#branching-and-merging)
- [using OpenAI functions with LangChain](https://python.langchain.com/docs/modules/chains/how_to/openai_functions)