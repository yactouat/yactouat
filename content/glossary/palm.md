---
subject: 'Machine learning'
term: 'palm'
---

`PaLM` is a Google LLM issued in April 2022. `PaLM` means _Pathways Language Model_.

It has 540 billions parameters.

It is a _dense decoder-only transformer_ model:

- _transformer_: type of models known for their ability to handle sequential data, like text, very efficiently; unlinke RNNs and LSTMs, transformers can be parallelized and are therefore much faster and scalable
- _decoder-only_: the model is only trained to generate continuation text based on its training data using its decoder part only; the decoder part learns how to decode representations for a relevant task
- _dense_: the model is trained to predict the next token in a sequence based on all previous tokens, not just the last one (attention mechanism)

`PaLM` was trained on multiple TPUs at the same time thanks to the `Pathways` system.

The `Pathways` system  is a kind of AI architecture developed by Google, is a significant advancement in artificial intelligence research. It's aimed at creating a single, general-purpose AI model capable of handling a wide range of tasks instead of being specialized. `Pathways` is designed handle many tasks at once, learn new tasks quickly, and reflects a better understanding of the World.

The `Pathways` system enables `PaLM` to orchestrate distributed computation for accelerators.