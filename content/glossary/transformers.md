---
subject: 'Machine Learning'
term: 'Transformers'
---

They are a specific type of neural network architecture used in deep learning. They are called _transformers_ because they transform one sequence into another. They are particularly good at handling sequences, like sentences in a language.

In a transformer model, the encoder's job is to understand the input, and the decoder's job is to produce the output.

The encoder is in charge of transforming the user input into an immediate representation of the input that the computer can understand better. The decoder then translates the encoder output into the desired final human-readable output.

Transformers rely heavily on a concept called _self-attention_. The self part of _self-attention_ refers to the "egocentric" focus of each token in a corpus. Effectively, on behalf of each token of input, _self-attention_ asks, "How much does every other token of input matter to me?" To simplify matters, let's assume that each token is a word and the complete context is a single sentence. Consider the following sentence:

> The animal didn't cross the street because it was too tired.

There are 11 words in the preceding sentence, so each of the 11 words is paying attention to the other ten, wondering how much each of those ten words matters to them. For example, notice that the sentence contains the pronoun `it`. Pronouns are often ambiguous. The pronoun `it` always refers to a recent noun, but in the example sentence, which recent noun does it refer to: the animal or the street?

The _self-attention_ mechanism determines the relevance of each nearby word to the pronoun `it`.

## Sources

- [Written intro to LLMs by Google](https://developers.google.com/machine-learning/resources/intro-llms)