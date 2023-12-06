---
subject: 'Machine learning'
title: 'PETM'
---

_Parameter-efficient tuning methods_ allow to tune an LLM on your custom data without having to re train the whole model.

In a PETM context, the base model itself is not altered; instead, a small number of add-on layers are tuned, and they can be swapped in and out at inference time.

Prompt tuning is one of the easiest PETM methods to implement.
