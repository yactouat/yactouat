---
excerpt: with the emergence of large multi modal models such as GPT-4 Vision or Gemini, which has multi-modality as its core, and also other open-source multi-modal models like Llava, it is important to understand how to use these models in practice. In this post, we will explore how  to do that
is_published: false
tags: [embeddings, lmms, ai, computer-vision]
thumbnail_ai_generated: true
thumbnail_img: multi-modal-embeddings.png
title: multi-modal embeddings in practice
---

## some theory

If you came to this article, it probably means that you already know what embeddings are in the field of AI: it's basically about transforming chunks of text into vectors of numbers. These vectors are then used to perform various tasks such as classification, clustering, or even generation. Now, we are arriving at a stage where pretty much everything can be transformed into embeddings: text, images, videos, audio, etc. This is what we call multi-modal embeddings.

Now, how can a text embedding and an image embedding relate ? Well, the idea is to project them into the same token space. You would then concatenate them and feed it to the model. So the basic steps to use a multi-modal model are:

- get the embeddings of your image
- project the image into the same token space as the text
- concatenate the two embeddings
- feed them to the model

For testing a multi-modal model, one interesting approach is to embed multimedia content and prepare questions and answers pairs about this content to evaluate the model. You can then use another model or a set of others models to check if the multi-modal model is able to answer the questions correctly.

To create embeddings for free and index them, you can use for instance [OpenClip](https://github.com/mlfoundations/open_clip) and Chroma.

<!-- TODO -->

## sources

- [OpenClip repo](https://github.com/mlfoundations/open_clip)
- [YouTube tutorial from LangChain channel about multi modal embeddings](https://www.youtube.com/watch?v=28lC4fqukoc)